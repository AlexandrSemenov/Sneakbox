<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Classes\CleanProductsService;

class ProductsTracing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ProductsTracing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display an inspiring quote';


    public function handle(CleanProductsService $cleanProducts)
    {
        $cleanProducts->sendEmailNotification();
        $cleanProducts->deleteOldProducts();
        $this->info('Products:Tracing Command Run successfully!');
    }
}