<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MachineModelAttachment extends Model
{
    use SoftDeletes;
	protected $guarded = [];
    
    public function saveAttachment($insert)
    {
    	return $this->create($insert);
    }

    public function updateAttachment($update,$id)
    {
    	return $this->find($id)->update($update);
    }

    public function deleteByMachineMold($id)
    {
    	return $this->where('machine_mold_id',$id)->delete();
    }
}
