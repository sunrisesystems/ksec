<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class NeckSize extends Model
{
    use SoftDeletes;
	protected $guarded = [];

    public function getNeckSizeById($id)
    {
    	return $this->find($id);
    }

    public function saveNeckSize($insert)
    {
    	$this->create($insert);
    }

    public function getNeckSizes($input)
    {
        $query = $this;
        if(isset($input['neckSize']) && !empty($input['neckSize'])){
            $query = $query->where('neck_size','like','%'.$input['neckSize'].'%');
        }
        if(isset($input['status']) && !empty($input['status'])){
            $query = $query->where('status',$input['status']);
        }
        $neckSize = $query->orderBy('id','desc')->paginate($input['paginationLimit']);
        return $neckSize;

    }

    public function updateNeckSize($update,$id)
    {
        return $this->find($id)->update($update);
    }
    
    public function deleteNeckSize($id)
    {
        return $this->find($id)->delete();
    }

    public function getNeckSizeList()
    {
        return $this->lists('neck_size','id')->toArray();
    }

    public function getNameById($id)
    {
        return $this->where('id',$id)->pluck('neck_size');
    }
}
