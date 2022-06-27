<?php

namespace App\Services\RandomUserApi;

use App\Contracts\ImportCustomerInterface;
use App\Models\Customer;
use Illuminate\Support\Facades\Http;

class ImportCustomerService implements ImportCustomerInterface
{
    private String $url;
    private static int $mininmum_limit = 100;
    private Array $columns =[
        'first_name',
        'last_name',
        'email',
        'username',
        'password',
        'gender',
        'country',
        'city',
        'phone',
    ];

    public function __construct()
    {
        $this->url = env('EXT_API_URL_VERSION') ?? '';
    }

    /**
     * Set URL
     *
     * @param  string $url
     * @return ImportCustomerService
     */

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * process for importing customers to the db
     *
     * @param  empty
     * @return Response
     */
    public function getCustomers(): mixed
    {
        // set minimum limit to fetch data and set country to australia
        $query = [
            'results' => self::$mininmum_limit,
            'nat' => 'AU'
        ];

        $response = Http::get($this->url, $query);
        if($response->getStatusCode() !== 200)
        {
            return response()->json(['errors'=>['API is unreacheable.']], 404);
        }
        $results = $response->json(['results']);
        $customers = [];
        if(is_iterable($results) ) {
            foreach($results as $key => $value){
                $customers[] = [
                    'first_name' => $value['name']['first'],
                    'last_name' => $value['name']['last'],
                    'email' => $value['email'],
                    'username' => $value['login']['username'],
                    'password' => md5($value['login']['password']),
                    'gender' => $value['gender'],
                    'country' => $value['nat'],
                    'city' => $value['location']['city'],
                    'phone' => $value['phone'],
                ];
            }
            //insert into db;
            Customer::upsert($customers,
            $this->columns,
            collect($this->columns)->reject(function($item,$key){
                return ($item === 'email');
            })->all());
        }
        return response()->json(['success'=>['Succesfully Imported data from 3rd party api.']], 201);
    }
}
