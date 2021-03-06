<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;

class SqFatal extends Model
{
    protected $table = 'sq_fatal';

    protected $guarded = [];

    public function saveFatal($insert)
    {
    	return $this->create($insert);
    }

    public function saveOrUpdateFatal($update,$existData)
    {
    	$sqFatal = $this->firstOrCreate($existData);
    	return $sqFatal->update($update);
    }
}
