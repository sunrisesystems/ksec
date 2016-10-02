<?php

namespace cvmapp;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function getActiveDepartmentList()
    {
    	return $this->where("status",'A')->lists('name','id')->toArray();
    }

    public function getAllDepartmentList()
    {
    	return $this->lists('name','id')->toArray();
    }
}
