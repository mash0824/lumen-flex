<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Arr;
use App\Http\Resources\CustomerResource;

class CustomerController extends Controller
{
    const ITEM_PER_PAGE = 15;

    /**
     * Display a listing of the customer resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|ResourceCollection
     */
    public function index(Request $request)
    {
        try {
            $searchParams = $request->all();
            $customerQuery = Customer::query();
            $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
            $keyword = Arr::get($searchParams, 'keyword', '');

            if (!empty($keyword)) {
                $customerQuery->where('first_name', 'LIKE', '%' . $keyword . '%');
                $customerQuery->orWhere('last_name', 'LIKE', '%' . $keyword . '%');
                $customerQuery->orWhere('email', 'LIKE', '%' . $keyword . '%');
            }

            return CustomerResource::collection($customerQuery->paginate($limit));
        }
        catch(\Exception $e) {
            return response()->json(['errors'=>['No query results.']], 400);
        }
    }

     /**
     * Display the specified resource.
     *
     * @param  int $customerId
     * @return CustomerResource|\Illuminate\Http\JsonResponse
     */
    public function show(int $customerId)
    {
        try {
            return new CustomerResource(Customer::findOrFail($customerId));
        }
        catch(\Exception $e) {
            return response()->json(['errors'=>['No query results.']], 400);
        }
    }
}
