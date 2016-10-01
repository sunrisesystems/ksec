<?php namespace ksec\Services;

use ksec\Drawing;
use ksec\Type;
use ksec\Store;
use ksec\Group;
use ksec\Color;
use ksec\CodeValue;
use ksec\Product;

use Request,Config,DB,Validator,Lang;
use ksec\Libraries\Lib;

class ProductService {

    public function __construct(Drawing $drawing,
                                Type $type,
                                Store $store,
                                Group $group,
                                Color $color,
                                CodeValue $codeValue,
                                Product $product)
    {
       $this->drawing = $drawing;
       $this->type = $type;
       $this->store = $store;
       $this->group = $group;
       $this->color = $color;
       $this->codeValue = $codeValue;
       $this->product = $product;
	}

       
    public function getAllData()
    {
        $data = [];
        $data['type'] = Lib::addSelect($this->type->getTypeList());
        $data['store'] = Lib::addSelect($this->store->getStoreList());
        $data['drawing'] = Lib::addSelect($this->drawing->getDrawingList());
        $data['group'] = Lib::addSelect($this->group->getGroupList());
        $data['color'] = Lib::addSelect($this->color->getColorList());
        $data['status'] = Lib::addSelect(Config::get('global_vars.STATUS_ARR'));
        $data['brand'] = Lib::addSelect($this->codeValue->getDataByCodeId(Config::get("global_vars.CODE_ID.Brand")));
        $data['primaryApplication'] = Lib::addSelect($this->codeValue->getDataByCodeId(Config::get("global_vars.CODE_ID.primary_application")));
        return $data;
    }  


    public function saveProduct($input)
    {
        return $this->product->saveProduct($input);
    } 

    public function getProducts($input)
    {
        $input['paginationLimit'] = Config::get("global_vars.PAGINATION_LIMIT");
      $data = $this->product->getProducts($input);
      return $data;
    }  

    public function getProductById($productId)
    {
      return $this->product->getProductById($productId);
    }

    public function updateProduct($update,$id)
    {
      return $this->product->updateProduct($update,$id);
    }

    public function checkDependancyForStore($storeId)
    {
      return $this->product->getByStoreId($storeId);
    }

    public function deleteProduct($id)
    {
        $result['success'] = 0;
        
        $this->product->deleteProduct($id);
        $result['success'] = 1;
        return $result; 

    }

    public function getStdValues($productId)
    {
      $drawing = $this->product->getDataWithDrawing($productId);
      $data = [
        'stdWt'=> $drawing->drawing->std_wt_c,
        'stdCt'=> $drawing->drawing->sct_c,
      ];
      return $data;
    }


    public function getProductDataForExcel()
    {
        $data = [];
        $molds = $this->product->getAllProducts();
        if(!empty($molds)){
            $supportData = $this->getAllData();
            $keys = ['Id', 'Trade Name','Type','Store','Group','Drawing','Color','Brand','Primary Application','Status'];
            array_push($data, $keys);
            
            foreach ($molds as $key => $value) {
                unset($value['created_at']);
                unset($value['updated_at']);
                unset($value['deleted_at']);
                $value['type_id'] = @$supportData['type'][$value['type_id']];
                $value['store_id'] = @$supportData['store'][$value['store_id']];
                $value['group_id'] = @$supportData['group'][$value['group_id']];
                $value['drawing_id'] = @$supportData['drawing'][$value['drawing_id']];
                $value['color_id'] = @$supportData['color'][$value['color_id']];
                $value['brand_id'] = @$supportData['brand'][$value['brand_id']];
                $value['primary_application_id'] = @$supportData['primaryApplication'][$value['primary_application_id']];
                $value['status'] = $supportData['status'][$value['status']];
                array_push($data, $value);
            }
        }
        return $data;
        
    }
}