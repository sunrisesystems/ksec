<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpType extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function getActiveEmpTypeList()
    {
    	return $this->where("status",'A')->lists('emp_type','id')->toArray();
    }

    public function getEmpTypeList()
    {
    	return $this->lists('emp_type','id')->toArray();
    }
}
