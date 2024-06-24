<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\CurrencyController;

class crawlingCurrency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:currency {code?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get currency data from external source.';

    public function __construct(CurrencyController $CurrencyController)
    {
        parent::__construct();
        $this->CurrencyController = $CurrencyController;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $code = $this->argument('code');

        if (!$code) {
            $this->error('Please provide at least one currency code.');
            return;
        }

        $result = $this->CurrencyController->fetchCurrencyData($code);

        $this->info(json_encode($result, JSON_PRETTY_PRINT));
    }
}
