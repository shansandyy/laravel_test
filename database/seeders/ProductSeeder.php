<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::upsert(
            [
                ['id' => 7, 'title' => 'pro7', 'content' => 'test7', 'price' => rand(1, 300), 'quantity' => rand(1, 50)],
                ['id' => 8, 'title' => 'pro8', 'content' => 'test8', 'price' => rand(1, 300), 'quantity' => rand(1, 50)],
            ],
            ['id'],
            ['price', 'quantity']
        );
    }
}
