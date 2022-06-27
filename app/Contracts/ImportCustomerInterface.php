<?php

namespace App\Contracts;

interface ImportCustomerInterface
{
    /**
     * This will use http to get the data from the api
     */
    public function getCustomers(): mixed;

}
