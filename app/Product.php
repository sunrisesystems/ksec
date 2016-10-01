<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
	use SoftDeletes;
    protected $guarded = [];

    public function getProductByDrawingId($drawingId)
    {
    	return $this->where('drawing_id',$drawingId)->count();
    }  

    public function saveProduct($insert)
    {
    	return $this->create($insert);  
    } 

    public function getProducts($input)
     {
        $query = $this;
        if(isset($input['tradeName']) && !empty($input['tradeName'])){
            $query = $query->where('trade_name','like','%'.$input['tradeName'].'%');
        }
        if(isset($input['status']) && !empty($input['status'])){
            $query = $query->where('status',$input['status']);
        }
        if(isset($input['shape']) && !empty($input['shape'])){
            $query = $query->where('bottle_shape_id',$input['shape']);
        }
        $products = $query->orderBy('id','desc')->paginate($input['paginationLimit']);
        return $products;
     } 

     public function getProductById($id)
     {
        return $this->find($id);
     }

     public function updateProduct($update,$id)
     {
        return $this->find($id)->update($update);
     }

     public function getByStoreId($storeId)
     {
        return $this->where('store_id',$storeId)->count();
     }

    public function checkDependancyForColor($colorId)
    {
        return $this->where('color_id',$colorId)->count();
    }

    public function deleteProduct($id)
    {
        return $this->find($id)->delete();
    }

    public function getProductList()
    {
        return $this->where('status','A')->lists('trade_name','id')->toArray();   
    }

    public function getProductListByDrawingId($drawingId)
    {
        return $this->where('status','A')->where('drawing_id',$drawingId)
        ->select(['trade_name','id'])->get()->toArray();   
       // return $this->where('status','A')->where('drawing_id',$drawingId)->lists('trade_name','id')->toArray();       
    }

    public function drawing()
    {
       return $this->hasOne(Drawing::class,'id','drawing_id');
    }


    public function getDataWithDrawing($productId)
    {
        return $this->with(['drawing'=>function($query){
                $query->select('id','sct_c','std_wt_c');
        }])->where('id',$productId)->first();
    }

    public function getAllProducts()
    {
        return $this->get()->toArray();
    }
}
