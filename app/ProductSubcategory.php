<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;

class ProductSubcategory extends Model
{
    protected $guarded = [];

    public function saveProductSubcategory($insert)
    {
    	return $this->create($insert);
    }

    public function getAllProductSubcategories($input)
    {
    	$query = $this;
        if(isset($input['name']) && !empty($input['name'])){
            $query = $query->where('name','like','%'.$input['name'].'%');
        }
        if(isset($input['status']) && !empty($input['status'])){
            $query = $query->where('status',$input['status']);
        }
        if(isset($input['productCategory']) && !empty($input['productCategory'])){
            $query = $query->where('product_category_id',$input['productCategory']);
        }

        $productSubcateogries = $query->orderBy('status','asc')->orderBy('id','desc')->paginate($input['paginationLimit']);
        return $productSubcateogries;
    }

    public function getProductSubcategoryById($id)
    {
        return $this->find($id);
    }

    public function updateProductSubcategory($update,$id)
    {
        return $this->find($id)->update($update);
    }
}
