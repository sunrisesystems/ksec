<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Defect extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    protected $table = 'defect';

    public function saveDefect($insert)
    {
    	return $this->create($insert);
    }

    public function getDefects($input){
    	$query = $this;
        if(isset($input['defectNature']) && !empty($input['defectNature'])){
            $query = $query->where('defect_nature_id',$input['defectNature']);
        }
        if(isset($input['defectReason']) && !empty($input['defectReason'])){
            $query = $query->where('mold_name','like','%'.$input['defectReason'].'%');
        }
        if(isset($input['defect']) && !empty($input['defect'])){
            $query = $query->where('defect','like','%'.$input['defect'].'%');
        }
        if(isset($input['status']) && !empty($input['status'])){
            $query = $query->where('status',$input['status']);
        }
        $defects = $query->orderBy('id','desc')->paginate($input['paginationLimit']);
        return $defects;
    }

    public function getDefectById($id){
    	return $this->find($id);
    }

    public function updateDefect($update,$id){
    	return $this->find($id)->update($update);
    }

    public function deleteDefect($id)
    {
    	return $this->find($id)->delete();
    }

    public function getAllDefectList()
    {
        return $this->where('status','A')->lists('defect','id')->toArray();
    }

    public function getAllDefects()
    {
        return $this->get()->toArray();
    }
}
