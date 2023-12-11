<?php

namespace App\DesignPatterns\Property\RelationalProperties;

use App\DesignPatterns\Property\RelationalProperty;
use App\Models\Country;

class CountryProperty extends RelationalProperty
{
    protected array $columns = [
        'id', 'name'
    ];

    public function model(): string
    {
        return Country::class;
    }

    public function assignInfo(array $info){}

}
