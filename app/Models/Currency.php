<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable= ['currency_price'];

    public function setSessionCurrencyAndChangeCurrency($code)
    {
        session(['currency'=>$code]);
    }
}
