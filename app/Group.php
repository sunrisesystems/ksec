<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Group extends Model
{
use SoftDeletes;
	protected $guarded = [];
    
    public function getGroupById($id)
    {
    	return $this->find($id);
    }

    public function saveGroup($insert)
    {
    	$this->create($insert);
    }

    public function getGroups($input)
    {
        $query = $this;
        if(isset($input['group']) && !empty($input['group'])){
            $query = $query->where('group','like','%'.$input['group'].'%');
        }
        if(isset($input['status']) && !empty($input['status'])){
            $query = $query->where('status',$input['status']);
        }
        $groups = $query->orderBy('id','desc')->paginate($input['paginationLimit']);
        return $groups;

    }

    public function updateGroup($update,$id)
    {
        return $this->find($id)->update($update);
    }
    
    public function deleteGroup($id)
    {
        return $this->find($id)->delete();
    }


    public function getGroupList()
    {
        return $this->where('status','A')->lists('group','id')->toArray();
    }
}
