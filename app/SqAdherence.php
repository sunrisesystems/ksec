<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;

class SqAdherence extends Model
{
    protected $table = 'sq_adherence';

    protected $guarded = [];

    public function saveAdherence($insert)
    {
    	return $this->create($insert);
    }
}
