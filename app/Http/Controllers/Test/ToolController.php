<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Jobs\UpdateProductPrice;

class ToolController extends Controller
{
    public function updatePrice()
    {
        // $user_data = ['name' => 'Feibe', 'email' => 'feibe@example.com', 'password' => 12345];

        // $products = Product::all();
        // foreach ($products as $product) {
        UpdateProductPrice::dispatchSync(6);
        // }
        // $job = (new UpdateProductPrice())->onQueue('email');
        // dispatch($job);
        return 'Done!';
    }
}
