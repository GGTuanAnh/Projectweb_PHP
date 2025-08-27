<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;

class ShowDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:show-data {table? : Table to show data for} {--limit=10 : Number of records to show}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display data from database tables in a formatted way';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $table = $this->argument('table');
        $limit = $this->option('limit');

        if (!$table) {
            $this->showTables();
            return;
        }

        switch (strtolower($table)) {
            case 'categories':
            case 'category':
                $this->showCategories($limit);
                break;
            case 'products':
            case 'product':
                $this->showProducts($limit);
                break;
            case 'product-categories':
                $this->showProductsWithCategories($limit);
                break;
            default:
                $this->error("Unknown table: {$table}");
                $this->showTables();
        }
    }

    protected function showTables()
    {
        $tables = ['categories', 'products', 'product-categories'];
        $this->info('Available tables:');
        
        foreach ($tables as $table) {
            $this->line("  - {$table}");
        }
        
        $this->line("\nExample usage:");
        $this->line("  php artisan app:show-data categories");
        $this->line("  php artisan app:show-data products --limit=5");
    }

    protected function showCategories($limit)
    {
        $categories = Category::take($limit)->get();
        
        if ($categories->isEmpty()) {
            $this->warn('No categories found.');
            return;
        }
        
        $headers = ['ID', 'Name', 'Slug', 'Description', 'Image', 'Created At'];
        $rows = [];
        
        foreach ($categories as $category) {
            $rows[] = [
                $category->id,
                $category->name,
                $category->slug,
                \Illuminate\Support\Str::limit($category->description, 30),
                $category->image,
                $category->created_at,
            ];
        }
        
        $this->table($headers, $rows);
        $this->info("Showing {$categories->count()} of " . Category::count() . " categories");
    }

    protected function showProducts($limit)
    {
        $products = Product::take($limit)->get();
        
        if ($products->isEmpty()) {
            $this->warn('No products found.');
            return;
        }
        
        $headers = ['ID', 'Name', 'Price', 'Category ID', 'Stock', 'Featured', 'Created At'];
        $rows = [];
        
        foreach ($products as $product) {
            $rows[] = [
                $product->id,
                $product->name,
                number_format($product->price) . ' VND',
                $product->category_id,
                $product->stock,
                $product->featured ? 'Yes' : 'No',
                $product->created_at,
            ];
        }
        
        $this->table($headers, $rows);
        $this->info("Showing {$products->count()} of " . Product::count() . " products");
    }

    protected function showProductsWithCategories($limit)
    {
        $products = Product::with('category')->take($limit)->get();
        
        if ($products->isEmpty()) {
            $this->warn('No products found.');
            return;
        }
        
        $headers = ['ID', 'Product Name', 'Price', 'Category', 'Stock', 'Featured'];
        $rows = [];
        
        foreach ($products as $product) {
            $rows[] = [
                $product->id,
                $product->name,
                number_format($product->price) . ' VND',
                $product->category ? $product->category->name : 'N/A',
                $product->stock,
                $product->featured ? 'Yes' : 'No',
            ];
        }
        
        $this->table($headers, $rows);
        $this->info("Showing {$products->count()} of " . Product::count() . " products with their categories");
    }
}
