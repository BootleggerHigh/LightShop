<?php

namespace App\Models;

use App\Mail\SubscriptionPush;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Subscription extends Model
{
    protected $guarded = [];

    public function scopeStatusSubscription($query,$product_id)
    {
        return $query->where('status',0)->where('product_id',$product_id);
    }

    public static  function sendPushSubscription(Product $product)
    {
        $subscribe = self::StatusSubscription($product->id)->get();
        foreach ($subscribe as $subscription)
        {
            Mail::to($subscription->email)->send(new SubscriptionPush($product));
            $subscription->status = 1;
            $subscription->save();
        }
    }
}
