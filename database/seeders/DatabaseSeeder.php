<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use \App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Product::create(['title' => 'pro11', 'content' => 'test11', 'price' => rand(1, 300), 'quantity' => rand(1, 50)]);
        $this->call(ProductSeeder::class);
        $this->command->info('產生固定 product 資料');
    }
}
