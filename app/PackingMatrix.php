<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackingMatrix extends Model
{
	use SoftDeletes;
    protected $guarded = [];
    protected $table = 'packing_matrix';

    public function savePacking($insert)
    {
    	return $this->create($insert);
    }

    public function checkUniqueness($data,$id = null)
    {
    	if(!empty($id)){
    		$result = $this->where('qty_per_box',$data['qty_per_box'])->where('product_id',$data['product_id'])->where('box_type',$data['box_type'])->where('type_of_packing',$data['type_of_packing'])->where('id','!=',$id)->count();
    	}else{
    		$result = $this->where('qty_per_box',$data['qty_per_box'])->where('product_id',$data['product_id'])->where('box_type',$data['box_type'])->where('type_of_packing',$data['type_of_packing'])->count();
    	}
    	return $result;
    }

    public function getPackings($input)
    {
    	$query = $this;
        if(isset($input['product']) && !empty($input['product'])){
            $query = $query->where('product_id',$input['product']);
        }
        if(isset($input['boxType']) && !empty($input['boxType'])){
            $query = $query->where('box_type',$input['boxType']);
        }
        if(isset($input['typeOfPacking']) && !empty($input['typeOfPacking'])){
            $query = $query->where('type_of_packing',$input['typeOfPacking']);
        }
        if(isset($input['status']) && !empty($input['status'])){
            $query = $query->where('status',$input['status']);
        }
        $packings = $query->orderBy('id','desc')->paginate($input['paginationLimit']);
        return $packings;
    }

    public function getPackingById($id)
    {
    	return $this->find($id);
    }

    public function updatePacking($update,$id)
    {
    	return $this->find($id)->update($update);
    }

    public function getDataByProductId($productId)
    {
        return $this->where('product_id',$productId)->where('status','A')->select(['product_id','box_type','qty_per_box'])->get()->toArray();
    }

    public function getQuantityPerBox($input)
    {
        return $this->where('box_type',$input['typeOfBox'])->where('product_id',$input['productId'])->where('type_of_packing',$input['typeOfPacking'])->pluck('qty_per_box');
    }

    public function getTypeOfBoxByProductId($productId)
    {
        return $this->where('product_id',$productId)->where('status','A')->lists('box_type')->toArray();
    }

    public function getTypeOfPacking($input)
    {
        return $this->where('box_type',$input['typeOfBox'])->where('product_id',$input['productId'])->select(['type_of_packing','qty_per_box'])->get();   
    }

    public function getAllPackingMatrix()
    {
        return $this->get()->toArray();
    }
}
