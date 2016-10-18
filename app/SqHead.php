<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;

class SqHead extends Model
{
    protected $table = 'sq_head';

    protected $guarded = [];

    public function saveSqHead($insert)
    {
    	return $this->create($insert);
    }
}
