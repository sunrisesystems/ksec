<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $guarded = [];
    
    public function saveProductCategory($insert)
    {
    	return $this->create($insert);
    }

    public function getAllProductCategories($input)
    {
    	$query = $this;
        if(isset($input['name']) && !empty($input['name'])){
            $query = $query->where('name','like','%'.$input['name'].'%');
        }
        if(isset($input['status']) && !empty($input['status'])){
            $query = $query->where('status',$input['status']);
        }
        if(isset($input['product']) && !empty($input['product'])){
            $query = $query->where('product_id',$input['product']);
        }

        $productCateogries = $query->orderBy('status','asc')->orderBy('id','desc')->paginate($input['paginationLimit']);
        return $productCateogries;
    }

    public function getProductCategoryById($id)
    {
    	return $this->find($id);
    }

    public function updateProductCategory($update,$id)
    {
    	return $this->find($id)->update($update);	
    }

    public function getProductCategoryList()
    {
        return $this->lists('name','id')->toArray();
    }

    public function getActiveProductCategoryList()
    {
        return $this->where("status",'A')->lists('name','id')->toArray();
    }
}
