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

    public function getSqHeadByFormId($input)
    {
    	$query = $this;
    	$result = $query->where('form_id',$input['form_id'])->paginate($input['paginationLimit']);
    	return $result;
    }

    // relationship with fatal
    public function sqFatal()
    {
        return $this->hasOne(SqFatal::class,'sq_head_id');
    }

    public function sqAdherence()
    {
        return $this->hasOne(SqAdherence::class,'sq_head_id');
    }

    public function sqQualityVoice()
    {
        return $this->hasOne(SqQualityVoice::class,'sq_head_id');
    }

    public function getSqHeadById($id)
    {
        return $this->with('sqFatal')->with('sqAdherence')->with('sqQualityVoice')->find($id);
    }

    public function updateSqHead($update,$id)
    {
        return $this->find($id)->update($update);
    }
}
