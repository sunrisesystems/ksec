<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    

    public function saveItem($input)
    {
    	return $this->create($input);
    }

    public function getItems($input)
    {
        $query = $this;
        if(isset($input['name']) && !empty($input['name'])){
            $query = $query->where('name','like','%'.$input['name'].'%');
        }
        if(isset($input['status']) && !empty($input['status'])){
            $query = $query->where('status',$input['status']);
        }
        /*if(isset($input['shape']) && !empty($input['shape'])){
            $query = $query->where('bottle_shape_id',$input['shape']);
        }*/
        $products = $query->orderBy('id','desc')->paginate($input['paginationLimit']);
        return $products;
    } 

    public function getItemById($id)
    {
    	return $this->find($id);
    }

    public function updateItem($update,$id)
    {
    	return $this->find($id)->update($update);
    }

    public function getByStoreId($storeId)
    {
        return $this->where('store_id',$storeId)->count();
    }

    public function checkByTypeId($typeId)
    {
        return $this->where('type_id',$typeId)->count();
    }

    public function getItemByGroupAndType($groupId,$typeId)
    {
        return $this->where('group_id',$groupId)->where('type_id',$typeId)->where('status','A')->lists('name','id')->toArray();
    }

    public function getDataByIds($ids)
    {
        return $this->whereIn('id',$ids)->lists('name','id')->toArray();
    }

    public function getAllItems()
    {
        return $this->get()->toArray();
    }
}
