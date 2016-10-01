<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PreformCondition extends Model
{
use SoftDeletes;
    protected $guarded = [];

    public function getPreformConditionList()
    {
    	return $this->lists('name','id')->toArray();
    }
}
