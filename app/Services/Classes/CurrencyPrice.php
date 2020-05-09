<?php

namespace App\Services\Classes;


use Exception;
use GuzzleHttp\Client;

class CurrencyPrice
{
    public static function getPrice()
    {
        $url = config('currency_price.api_url').'?base='.session('currency');
        $client = new Client();
        $response = $client->request('GET',$url);
        if(!$response->getStatusCode() === 200)
        {
            throw new Exception('сервер у api потух');
        }
        $price =  json_decode($response->getBody()->getContents(),true)["rates"];
        foreach (CurrencyCode::getCurrencies() as $currency)
        {
                if(!isset ($price[$currency->name_currency]))
                {
                    $currency->currency_price = '1';
                }
                else
                {
                    $currency->update(['currency_price'=>$price[$currency->name_currency]]);
                    $currency->touch();
                }

            }
        }
    }
