<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Contracts\ImportCustomerInterface;

class ImportCustomerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:customers'; // for future use we can add arg {--country_code=?} {--limit=?}

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import customers from 3rd party API';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(private ImportCustomerInterface $importCustomerService)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Importing Customer(s) From 3rd Party API.');
        /**
         * call the randomAPi Service Provider.
         */
        $response = $this->importCustomerService->getCustomers();
        if($response->getStatusCode() != 201) {
            $this->info('Importing Customer(s) Failed.');
        }
        else {
            $this->info('Imported Customer(s) Successfully.');
        }
    }
}
