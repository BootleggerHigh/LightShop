<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Subscription;

class SubscribeToProduct
{
//    /**
//     * Handle the product "created" event.
//     *
//     * @param \App\Models\Product $product
//     * @return void
//     */
//    public function created(Product $product)
//    {
//
//    }

    /**
     * Handle the product "updated" event.
     *
     * @param \App\Models\Product $product
     * @return void
     */
    public function updated(Product $product)
    {
        $old = $product->getOriginal('product_count');
        if($old === 0 && $product->product_count > 0)
        {
            Subscription::sendPushSubscription($product);
        }
    }
}
