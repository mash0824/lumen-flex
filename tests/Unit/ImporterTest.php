<?php

namespace Tests\Unit;

use App\Services\Test\ImportCustomerService;
use App\Models\Customer;
use Tests\TestCase;

class ImporterTest extends TestCase
{
    /**
     * test the ImportCustomer Service
     * Check if it can succesfully
     * call the api and create new entry on db
     *
     * @return void
     */
    public function test_import_service()
    {
        $import = new ImportCustomerService();
        $response = $import->getCustomers();
        $this->assertTrue($response);
    }

    /**
     * test the customer insert
     * Check if it can succesfully
     *
     * @return void
     */
    public function test_create_customers()
    {
        $customer = \App\Models\Customer::factory()->create();
        $this->assertInstanceOf(Customer::class,$customer);
    }

    /**
     * test the customer endpoint
     * Check if it can succesfully
     *
     * @return void
     */
    public function test_get_customers()
    {
        $this->get('/customers')->assertResponseStatus(200);

    }

    /**
     * test the customer/{customerId} endpoint
     * Check if it can succesfully
     *
     * @return void
     */
    public function test_get_customer_by_id()
    {
        $this->get('/customers/'.random_int(1,10))->assertResponseStatus(200);
    }
}
