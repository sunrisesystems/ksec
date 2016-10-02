<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];

    public function getAllCities()
    {
    	$this->lists('city','id')->toArray();
    }
}
