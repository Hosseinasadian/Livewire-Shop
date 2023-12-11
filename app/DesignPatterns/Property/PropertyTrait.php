<?php

namespace App\DesignPatterns\Property;

use App\DesignPatterns\Property\NonRelationalProperties\BooleanProperty;
use App\DesignPatterns\Property\NonRelationalProperties\NonNumericProperty;
use App\DesignPatterns\Property\NonRelationalProperties\NumericProperty;
use App\DesignPatterns\Property\NonRelationalProperties\SelectProperty;
use App\DesignPatterns\Property\RelationalProperties\CountryProperty;

trait PropertyTrait
{
    /**
     * @throws \Exception
     */
    public function getPropertyClass($class,$info):Property
    {
        return match ($class) {
            'country' => new CountryProperty($info),
            'boolean' => new BooleanProperty($info),
            'select' => new SelectProperty($info),
            'numeric' => new NumericProperty($info),
            'not_numeric' => new NonNumericProperty($info),
            default => throw new \Exception('Invalid property type selected'),
        };
    }

}
