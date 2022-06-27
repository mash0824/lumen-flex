<?php

namespace App\Services\Test;

use App\Contracts\ImportCustomerInterface;
use App\Models\Customer;
use App\Http\Resources\CustomerFakeResource;

class ImportCustomerService implements ImportCustomerInterface
{
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

    /**
     * process for importing customers to the db
     *
     * @param  empty
     * action dataprovider is generated by factory
     * to simulate the data provider.
     * @return Response
     */
    public function getCustomers(): mixed
    {
        $data = \App\Models\Customer::factory(100)->make();
        $results = CustomerFakeResource::collection($data)->all();
        $customers = [];
        if(is_iterable($results) ) {
            foreach($results as $key => $value){
                $customers[] = [
                    'first_name' => $value->first_name,
                    'last_name' => $value->last_name,
                    'email' => $value->email,
                    'username' => $value->username,
                    'password' => $value->password,
                    'gender' => $value->gender,
                    'country' => $value->country,
                    'city' => $value->city,
                    'phone' => $value->phone,
                ];
            }
            //insert into db;
            Customer::upsert($customers,
            $this->columns,
            collect($this->columns)->reject(function($item){
                return ($item === 'email');
            })->all());
            return true;
        }
        return false;
    }
}
