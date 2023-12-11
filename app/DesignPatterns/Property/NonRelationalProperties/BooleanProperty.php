<?php

namespace App\DesignPatterns\Property\NonRelationalProperties;

use App\DesignPatterns\Property\NonRelationalProperty;

class BooleanProperty extends NonRelationalProperty
{
    public function assignInfo(array $info){
        dump('assignInfo in BooleanProperty');
    }

}
