<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    protected $guarded = [];

    public function getAllActiveProcessList()
    {
    	return $this->where("status",'A')->lists('process','id')->toArray();
    }
}
