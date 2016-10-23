<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;

class SqQualityVoice extends Model
{
    protected $guarded = [];
    
    protected $table = 'sq_quality_voice';

    public function saveQualityVoice($insert)
    {
    	return $this->create($insert);
    }
}
