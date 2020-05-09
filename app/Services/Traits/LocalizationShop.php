<?php


namespace App\Services\Traits;

use Illuminate\Support\Facades\App;

trait LocalizationShop
{
    private $localization_en = '_en';
    public function __localization($column)
    {

        if(App::getLocale() ==='en')
        {
            $fieldName_en = $column."$this->localization_en";

            if(array_key_exists($fieldName_en,$this->toArray()) && (!empty($this->$fieldName_en)) )
            {
                return $this->$fieldName_en;
            }
        }
        return $this->$column;
    }
}
