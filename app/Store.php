<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Store extends Model
{
use SoftDeletes;
    protected $table = 'classes';
	protected $guarded = [];

	public function getStoreById($id)
    {
    	return $this->find($id);
    }

    public function getStores($input)
    {
        $query = $this;
        if(isset($input['store']) && !empty($input['store'])){
            $query = $query->where('class','like','%'.$input['store'].'%');
        }
        if(isset($input['status']) && !empty($input['status'])){
            $query = $query->where('status',$input['status']);
        }
        $stores = $query->orderBy('id','desc')->paginate($input['paginationLimit']);
        return $stores;

    }

    public function saveStore($insert)
    {
    	return $this->create($insert);
    }

    public function updateStore($update,$id)
    {
    	return $this->find($id)->update($update);
    }

    public function deleteStore($id)
    {
    	return $this->find($id)->delete();
    }

    public function getStoreList()
    {
        return $this->where('status','A')->lists('class','id')->toArray();
    }
}
