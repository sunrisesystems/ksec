<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
	use SoftDeletes;
	protected $guarded = [];
    
    public function getColorById($id)
    {
    	return $this->find($id);
    }

    public function saveColor($insert)
    {
    	$this->create($insert);
    }

    public function getColors($input)
    {
        $query = $this;
        if(isset($input['color']) && !empty($input['color'])){
            $query = $query->where('color','like','%'.$input['color'].'%');
        }
        if(isset($input['status']) && !empty($input['status'])){
            $query = $query->where('status',$input['status']);
        }
        $shapes = $query->orderBy('id','desc')->paginate($input['paginationLimit']);
        return $shapes;

    }

    public function updateColor($update,$id)
    {
        return $this->find($id)->update($update);
    }
    
    public function deleteColor($id)
    {
        return $this->find($id)->delete();
    }

    public function getColorList()
    {
        return $this->where('status','A')->lists('color','id')->toArray();
    }  
}
