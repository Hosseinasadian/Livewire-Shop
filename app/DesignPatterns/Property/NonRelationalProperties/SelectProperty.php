<?php

namespace App\DesignPatterns\Property\NonRelationalProperties;

use App\DesignPatterns\Property\NonRelationalProperty;

class SelectProperty extends NonRelationalProperty
{
    protected array $options = [];

    public function index()
    {
/*        $prop = [
            'type' => 'country | numeric | not_numeric | boolean',
            'multiple' => 'true | false',
            'options' => ['op1','op2','op3'],// if class is select,
        ];*/
    }

    public function assignInfo(array $info){}


}
