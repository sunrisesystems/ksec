<?php namespace ksec\Services;

use ksec\Product;
use ksec\CodeValue;
use ksec\Item;
use ksec\PackingMatrix;

use Request,Config,DB,Validator,Lang;
use ksec\Libraries\Lib;

class PackingService {

   public function __construct(Product $product,
                              CodeValue $codeValue,
                              Item $item,
                              PackingMatrix $packingMatrix)
   {
      $this->product = $product;
      $this->codeValue = $codeValue;
      $this->item = $item;
      $this->packing = $packingMatrix;
   }

       
   public function getAllData()
   {
      $groupId = Config::get('global_vars.HARD_CODED_ID.PACKING_MATERIAL_GROUP_ID');
      $typeId = Config::get('global_vars.HARD_CODED_ID.CARTON_TYPE_ID');
      $data = [];
      $data['product'] = Lib::addSelect($this->product->getProductList());
      $data['boxType'] = Lib::addSelect($this->item->getItemByGroupAndType($groupId,$typeId));
      $data['status'] = Lib::addSelect(Config::get('global_vars.STATUS_ARR'));
      $data['typeOfPacking'] = Lib::addSelect($this->codeValue->getDataByCodeId(Config::get("global_vars.CODE_ID.type_of_packing")));
      return $data;
   }

   public function savePacking($input)
   {
      $result = [
         'success' => 0,
         'data' => Lang::get('messages.ERROR'),
      ];
      try {
         // check for uniqueness
         $uniqueCount = $this->packing->checkUniqueness($input);
         if($uniqueCount){
            $result['data'] = Lang::get('messages.qty_per_box_packing_unique');
         }else{
            $packing = $this->packing->savePacking($input);
            if(count($packing)){
               $result['success'] = 1;
               unset($result['data']);
            }
         }
      } catch (Exception $e) {
         $result['data'] = $e->getMessage();
      }
      return $result;
   }

   public function getPackings($input)
   {
      $input['paginationLimit'] = Config::get("global_vars.PAGINATION_LIMIT");
      $data = $this->packing->getPackings($input);
      return $data;
   }

   public function getPackingById($id)
   {
      return $this->packing->getPackingById($id);
   }

   public function updatePacking($input,$id)
   {
      $result = [
         'success' => 0,
         'data' => Lang::get('messages.ERROR'),
      ];
      try {
         // check for uniqueness
         $uniqueCount = $this->packing->checkUniqueness($input,$id);
         if($uniqueCount){
            $result['data'] = Lang::get('messages.qty_per_box_packing_unique');
         }else{
            $packing = $this->packing->updatePacking($input,$id);
            if($packing){
               $result['success'] = 1;
               unset($result['data']);
            }
         }
      } catch (Exception $e) {
         $result['data'] = $e->getMessage();
      }
      return $result;
   }

   public function getPackingDataForExcel()
    {
        $data = [];
        $packingMatrix = $this->packing->getAllPackingMatrix();
        if(!empty($packingMatrix)){
            $supportData = $this->getAllData();
            $keys = ['Id', 'Product Name','Box Type','Type Of Packing','Quantity Per Box','Status'];
            array_push($data, $keys);
            
            foreach ($packingMatrix as $key => $value) {
                unset($value['created_at']);
                unset($value['updated_at']);
                unset($value['deleted_at']);
                $value['product_id'] = @$supportData['product'][$value['product_id']];
                $value['box_type'] = @$supportData['boxType'][$value['box_type']];
                $value['type_of_packing'] = @$supportData['typeOfPacking'][$value['type_of_packing']];
                $value['status'] = $supportData['status'][$value['status']];
                array_push($data, $value);
            }
        }
        return $data;
        
    }
   
}