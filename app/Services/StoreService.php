<?php namespace ksec\Services;

use ksec\Store;
use Request,Config;
use ksec\Libraries\Lib;
use ksec\Services\MachineService;
use ksec\Services\MoldService;
use ksec\Services\ProductService;
use ksec\Services\ItemService;

class StoreService {

    public function __construct(Store $store,
                                MachineService $machineService,
                                MoldService $moldService,
                                ProductService $productService,
                                ItemService $itemService)
    {
        $this->store = $store;
        $this->productService = $productService; 
        $this->moldService = $moldService;
        $this->machineService = $machineService;
        $this->itemService = $itemService;
	}

    public function saveStore($input)
    {
        $input = Lib::trimInput($input);
        return $this->store->saveStore($input);
    }

    public function getStores($input)
    {
        $input = Lib::trimInput($input);
    	$input['paginationLimit'] = Config::get("global_vars.PAGINATION_LIMIT");
    	$shapes = $this->store->getStores($input);
    	return $shapes;
    }

    public function getStore($id)
    {
    	return $this->store->getStoreById($id);
    }

    public function updateStore($update,$id)
    {
        $update = Lib::trimInput($update);
    	return $this->store->updateStore($update,$id);
    }

    public function deleteStore($id)
    {
        $result['success'] = 0;
        /* dependancy check on machine model,mold and product and item */
        $machineModel = $this->machineService->checkMachineModelDependancyForStore($id);
        if($machineModel){
            $result['data'] = Lang::get('messages.MACHINE_MODEL_STORE_DEPENDANCY');
            return $result;
        }
        $mold = $this->moldService->checkDependancyForStore($id);
        if($mold){
            $result['data'] = Lang::get('messages.MOLD_STORE_DEPENDANCY');
            return $result;
        }
        $product = $this->productService->checkDependancyForStore($id);
        if($product){
            $result['data'] = Lang::get('messages.PRODUCT_STORE_DEPENDANCY');
            return $result;
        }
        $item = $this->itemService->checkDependancyForStore($id);
        if($item){
            $result['data'] = Lang::get('messages.item_store_dependancy');
            return $result;
        }
    	$this->store->deleteStore($id);
        $result['success'] = 1;
        return $result;    
    }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
}