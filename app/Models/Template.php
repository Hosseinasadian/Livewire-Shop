<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Template extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected $casts=[
        'properties'=>'array'
    ];

    public function properties()
    {
        return $this->hasMany(Property::class);
    }
//    properties
//    country - color - boolean

}
