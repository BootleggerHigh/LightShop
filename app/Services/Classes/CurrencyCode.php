<?php


namespace App\Services\Classes;
use App\Models\Currency;
use Carbon\Carbon;

class CurrencyCode
{
    protected static $all_code_currency;

    private static function loadAllCodeCurrency()
    {
        if(is_null(self::$all_code_currency))
        {
            $currencies = Currency::get();
            foreach ($currencies as $currency)
            {
                self::$all_code_currency[$currency->name_currency] = $currency;
            }

        }
    }
    public static function convert($sum,$target_currency_code=null,$original_currency_code="RUB")
    {
        self::loadAllCodeCurrency();
        $originCurrency = self::$all_code_currency[$original_currency_code];

        if ($originCurrency->currency_price === 0 || $originCurrency->updated_at->startOfDay() != Carbon::now()->startOfDay()) {
            CurrencyPrice::getPrice();
            self::loadAllCodeCurrency();
            $originCurrency = self::$all_code_currency[$original_currency_code];
        }

        if(is_null($target_currency_code))
        {
            if(is_null(session()->get('currency')))
            {
                session()->put(['currency'=>$original_currency_code]);
                $target_currency_code = $original_currency_code;
            }
            else
            {
                $target_currency_code = session('currency');
            }
        }
        $targetCurrency = self::$all_code_currency[$target_currency_code];
        if ($targetCurrency->rate === 0 || $targetCurrency->updated_at->startOfDay() != Carbon::now()->startOfDay()) {
            CurrencyPrice::getPrice();
            self::loadContainer();
            $targetCurrency = self::$all_code_currency[$target_currency_code];
        }

        return $sum / $originCurrency->currency_price  * $targetCurrency->currency_price ;
    }

    public static function getCurrencies ()
    {
        self::loadAllCodeCurrency();
        return self::$all_code_currency;
    }


    public static function getCodeCurrency()
    {
        self::loadAllCodeCurrency();
        return self::$all_code_currency[session('currency')]->name_currency;
    }
}
