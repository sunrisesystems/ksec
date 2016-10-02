<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];

    public function getAllCities()
    {
    	return $this->lists('city','id')->orderBy('id','asc')->toArray();
    }
}
