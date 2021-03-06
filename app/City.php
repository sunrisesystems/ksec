<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];

    public function getAllCities()
    {
    	return $this->orderBy('id','asc')->lists('city','id')->toArray();
    }
}
