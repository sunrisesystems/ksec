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

    public function updateQualityVoice($update,$sqHeadId)
    {
    	return $this->where('sq_head_id',$sqHeadId)->update($update);
    }
}
