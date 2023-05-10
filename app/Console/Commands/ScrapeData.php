<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use Illuminate\Support\Str;

class ScrapeData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:data {pageCount}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Scrape's data from https://sugargang.com/collections/alle-produkte";

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
        $client = new Client();
        $pages = $this->argument('pageCount');

        /**
         * Count page numbers
         * 
        */
        $crawler = $client->request('GET', 'https://sugargang.com/collections/alle-produkte');
        
        $totalPages = ($crawler->filter('.pagination .pagination__nav-item')->count()) 
                    ? ($crawler->filter('.pagination .pagination__nav-item')->count() + 1) : 0;

        if($pages == 'all') {
            $pages = $totalPages;
        }
        
        if($pages > $totalPages) {
            return $this->info("Error: Number of page input not allowed. Maximum allowed input: {$totalPages}. Try `php artisan scrape:data all`");
        }

        for ($i = 0; $i < $pages; $i++) {
            if ($i != 0) {
                $crawler = $client->request('GET', 'https://sugargang.com/collections/alle-produkte?page='.$i);
            }
    
            $crawler->filter('.product-item')->each(function ($node) use ($client) {

                // Product Title
                $product_title = trim($node->filter('.product-item__title')->text());

                // Price
                $price = trim($node->filter('.product-item__price-list .price')->text());
                $price = str_replace("Sonderpreis", '', $price);
                $price = str_replace(",", ".", $price);

                // Product Image
                $imageLink = $node->filter('a')->link();
                $uri = $imageLink->getUri();
                $product = $client->request('GET', $uri);
                $product_image = $product->filter('.product-gallery__image')->attr('data-zoom');

                // Ingredients (inconsistent data)
                $product_ingredients = trim($product->filter('.card__collapsible:nth-of-type(2)')->text());
                $dummy_data = "This is a test value. Ingredients' data from the source is inconsistent that leads to error.";

                Product::create([
                    'product_title' => $product_title,
                    'price' => $price,
                    'quantity' => rand(1, 25), // random dummy quantity, no specific value found from the source
                    'product_image' => $product_image,
                    'product_ingredients' => $product_ingredients ?? $dummy_data,
                    'sku' => Str::slug($product_title) // dummy SKU, no specific SKU from the source
                ]);

                $products = Product::all();

                $this->info("Scraping data... Please wait... (".count($products).") record/s saved.");
            });
        }
        return $this->info("Scraped data has been saved.");
    }
}
