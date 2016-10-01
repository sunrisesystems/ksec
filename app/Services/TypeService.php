<?php namespace ksec\Services;

use ksec\Type;
use Request,Config,Lang;
use ksec\Libraries\Lib;
use ksec\Services\MoldService;
use ksec\Services\MachineService;
use ksec\Services\DrawingService;
use ksec\Services\ItemService;
use ksec\Group;


class TypeService {

    public function __construct(Type $type,
                                Group $group,
                                MoldService $moldService,
                                MachineService $machineService,
                                DrawingService $drawingService,
                                ItemService $itemService)
    {
        $this->type = $type;
        $this->moldService = $moldService;
        $this->machineService = $machineService;
        $this->drawingService = $drawingService;
        $this->group = $group;
        $this->itemService = $itemService;
	}

    public function saveType($input)
    {
        return $this->type->saveType($input);
    }

    public function getTypes($input)
    {
        $input = Lib::trimInput($input);
    	$input['paginationLimit'] = Config::get("global_vars.PAGINATION_LIMIT");
    	$types = $this->type->getTypes($input);
    	return $types;
    }

    public function getData()
    {
        $data['status'] = Lib::addSelect(Config::get('global_vars.STATUS_ARR'));
        $data['group'] = Lib::addSelect($this->group->getGroupList());
        return $data;
    }
    public function getType($id)
    {
    	return $this->type->getTypeById($id);
    }

    public function updateType($update,$id)
    {
    	return $this->type->updateType($update,$id);
    }

    public function deleteType($id)
    {
        $result['success'] = 0;
        /* dependancy check on drawing,machine model and mold */
        $machineModel = $this->machineService->checkMachineModelDependancyForType($id);
        if($machineModel){
            $result['data'] = Lang::get('messages.MACHINE_MODEL_TYPE_DEPENDANCY');
            return $result;
        }
        $mold = $this->drawingService->checkDependancyForType($id);
        if($mold){
            $result['data'] = Lang::get('messages.DRAWING_TYPE_DEPENDANCY');
            return $result;
        }
        $product = $this->moldService->checkDependancyForType($id);
        if($product){
            $result['data'] = Lang::get('messages.MOLD_TYPE_DEPENDANCY');
            return $result;
        }
        $item = $this->itemService->checkDependancyForType($id);
        if($item){
            $result['data'] = Lang::get('messages.item_type_dependancy');
            return $result;
        }
    	$this->type->deleteType($id);
        $result['success'] = 1;
        return $result;  
    }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
}