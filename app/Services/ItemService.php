<?php namespace ksec\Services;

use ksec\Type;
use ksec\Store;
use ksec\Group;
use ksec\Item;


use Request,Config,DB,Validator,Lang;
use ksec\Libraries\Lib;

class ItemService {

   public function __construct(Type $type,
                              Store $store,
                              Group $group,
                              Item $item
                              )
   {
      $this->type = $type;
      $this->store = $store;
      $this->group = $group;
      $this->item = $item;
   }

       
   public function getAllData()
   {
      $data = [];
      $data['type'] = $this->type->getTypeWithGroup();
      $data['store'] = Lib::addSelect($this->store->getStoreList());
      $data['group'] = Lib::addSelect($this->group->getGroupList());
      $data['status'] = Lib::addSelect(Config::get('global_vars.STATUS_ARR'));
      return $data;
   }

   public function getAllDataForIndex()
   {
      $data = [];
      $data['type'] = $this->type->getTypeList();
      $data['store'] = Lib::addSelect($this->store->getStoreList());
      $data['group'] = Lib::addSelect($this->group->getGroupList());
      $data['status'] = Lib::addSelect(Config::get('global_vars.STATUS_ARR'));
      return $data;
   }

   public function saveItem($input)
   {
      return $this->item->saveItem($input);
   }  

   public function getItems($input)
   {
      $input['paginationLimit'] = Config::get("global_vars.PAGINATION_LIMIT");
      $data = $this->item->getItems($input);
      return $data;
   } 

   public function getItemById($id)
   {
      return $this->item->getItemById($id);
   } 

   public function updateItem($update,$id)
   {
      return $this->item->updateItem($update,$id);
   }

   public function checkDependancyForStore($storeId)
   {
      return $this->item->getByStoreId($storeId);
   }

   public function checkDependancyForType($typeId)
   {
      return $this->item->checkByTypeId($typeId);
   }

       public function getItemDataForExcel()
    {
        $data = [];
        $molds = $this->item->getAllItems();
        if(!empty($molds)){
            $supportData = $this->getAllDataForIndex();
            $keys = ['Id', 'Item Name','Short Description','Type','Store','Group','Status'];
            array_push($data, $keys);
            
            foreach ($molds as $key => $value) {
                unset($value['created_at']);
                unset($value['updated_at']);
                unset($value['deleted_at']);
                $value['type_id'] = @$supportData['type'][$value['type_id']];
                $value['store_id'] = @$supportData['store'][$value['store_id']];
                $value['group_id'] = @$supportData['group'][$value['group_id']];
                $value['status'] = $supportData['status'][$value['status']];
                array_push($data, $value);
            }
        }
        return $data;
        
    }
}