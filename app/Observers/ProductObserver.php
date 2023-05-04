<?php

namespace App\Observers;

use App\Models\Product;
use App\Notifications\ProductReplenish;
use Illuminate\Support\Arr;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        //
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        $change = arr::only($product->getChanges(), ['quantity']);
        $original = $product->getOriginal();

        if (isset($change['quantity']) && $product->quantity > 0 && $original['quantity'] == 0) {
            foreach ($product->favorite_user as $user) {
                $user->notify(new ProductReplenish($product));
            }
        }
    }
    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}
