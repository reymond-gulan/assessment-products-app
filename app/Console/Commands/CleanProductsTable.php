<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;

class CleanProductsTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Delete's all data from products table for testing purposes";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $delete = Product::whereNotNull('product_title')->delete();
        return $this->info("All records from products table has been deleted.");
    }
}
