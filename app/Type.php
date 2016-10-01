<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Type extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    
    public function getTypeById($id)
    {
    	return $this->find($id);
    }

    public function saveType($insert)
    {
    	return $this->create($insert);
    }

    public function getTypes($input)
    {
        $query = $this;
        if(isset($input['group']) && !empty($input['group'])){
            $query = $query->where('group_id',$input['group']);
        }
        if(isset($input['type']) && !empty($input['type'])){
            $query = $query->where('type','like','%'.$input['type'].'%');
        }
        if(isset($input['status']) && !empty($input['status'])){
            $query = $query->where('status',$input['status']);
        }
        $types = $query->orderBy('id','desc')->paginate($input['paginationLimit']);
        return $types;

    }

    public function updateType($update,$id)
    {
        return $this->find($id)->update($update);
    }
    
    public function deleteType($id)
    {
        return $this->find($id)->delete();
    }

    public function getTypeList()
    {
        return $this->where('status','A')->lists('type','id')->toArray();
    }

    public function getNameById($id)
    {
        return $this->where('id',$id)->pluck('type');
    }

    public function getTypeListByGroupId($groupId)
    {
        return $this->where('status','A')->where('group_id',$groupId)->lists('type','id')->toArray();
    }

    public function getTypeWithGroup()
    {
        return $this->where('status','A')->select(['group_id','type','id'])->get()->toArray();
    }
}
