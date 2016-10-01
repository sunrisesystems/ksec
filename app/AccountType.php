<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    protected $guarded = [];

    public function getAccountTypeList()
    {
    	return $this->lists('type','id')->toArray();
    }
}
