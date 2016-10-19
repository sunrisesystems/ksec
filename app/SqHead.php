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
}
