<?php namespace ksec\Services;

use ksec\Type;
use ksec\Store;
use ksec\Group;
use ksec\MachineModel;
use ksec\Machine;
use ksec\MachineModelAttachment;
use ksec\Account;
use ksec\Unit;
use ksec\CodeValue;
use Request,Config,DB,Validator,Sentinel;
use ksec\Libraries\Lib;


class MachineService {

    public function __construct(Type $type,
                                Store $store,
                                Group $group,
                                Account $account,
                                MachineModel $machineModel,
                                CodeValue $codeValue,
                                MachineModelAttachment $machineModelAttachment,
                                Machine $machine,
                                Unit $unit)
    {
        $this->type = $type;
        $this->group = $group;
        $this->store = $store;
        $this->machine = $machine;
        $this->account = $account;
        $this->machineModel = $machineModel;
        $this->codeValue = $codeValue;
        $this->machineModelAttachment = $machineModelAttachment;
        $this->unit = $unit;
    }
    

    public function getMachineModelData()
    {
        $data = [];
        $data['type'] = Lib::addSelect($this->type->getTypeListByGroupId(Config::get('global_vars.HARD_CODED_ID.MACHINE_GROUP_ID')));
        $data['store'] = Lib::addSelect($this->store->getStoreList());
        $data['screwRatio'] = Lib::addSelect($this->codeValue->getDataByCodeId(Config::get("global_vars.CODE_ID.Screw L/ D Ratio")));
        $data['actuation'] = Lib::addSelect($this->codeValue->getDataByCodeId(Config::get("global_vars.CODE_ID.Actuation")));
        $data['actuator1'] = Lib::addSelect($this->codeValue->getDataByCodeId(Config::get("global_vars.CODE_ID.Actuator 1")));
        $data['actuator2'] = Lib::addSelect($this->codeValue->getDataByCodeId(Config::get("global_vars.CODE_ID.Actuator 2")));
        $data['manufacturer'] = Lib::addSelect($this->account->getVendorTypeAccountList());
        $data['status'] = Lib::addSelect(Config::get('global_vars.STATUS_ARR'));
        return $data;
    } 

    public function saveMachineModel($input,$imageData)
    {
       try {
            DB::beginTransaction();
            unset($input['attachments']);

            $insert = $this->machineModel->saveMachineModel($input);
            /* upload drawing_file */
            if(!empty($imageData['attachments'])){
                $rules = [
                    'attachment'=> 'required|mimes:jpeg,bmp,png,pdf.jpg'
                ];
                foreach ($imageData['attachments'] as $key => $value) {
                    $validation = Validator::make(['attachment'=>$value],$rules);
                    if($validation->passes()){
                        $data = [];
                        $data['machine_model_id'] = $insert->id;
                        $data['file_name'] = 'null';
                        $drawingAtt = $this->machineModelAttachment->saveAttachment($data);
                        $fileName = Lib::uploadImage($value,Config::get('global_vars.PRODUCT_TYPE.MACHINE_MOLD_ATTACHMENT_PRODUCT_TYPE'),$insert->id,[],'MMA_'.$drawingAtt->id);
                        $update = [];
                        $update['file_name'] = $fileName;
                        $updateSucc = $this->machineModelAttachment->updateAttachment($update,$drawingAtt->id);
                    }else{
                        DB::rollback();
                        return false;
                    }
                }
                DB::commit();
            }else{
                DB::commit();
            }
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
        return true;
    } 

    public function getMachineModels($input)
    {
        $input['paginationLimit'] = Config::get("global_vars.PAGINATION_LIMIT");
        $molds = $this->machineModel->getMachineModels($input);
        return $molds;
    } 

    public function getMachines($input)
    {
        $input['paginationLimit'] = Config::get("global_vars.PAGINATION_LIMIT");
        $input['unitId'] = Sentinel::getUser()->unit_id;
        $machines = $this->machine->getMachines($input);
        return $machines;
    }
   public function getMachineModelById($id)
    {
        return $this->machineModel->getMachineModelById($id);
    } 

    public function getMachine($id)
    {
        return $this->machine->getMachineById($id);
    } 

    public function updateMachineModel($input,$imageData,$id)
    {
        try {
            unset($input['attachment_file']);
            unset($input['attachments']);
            DB::beginTransaction();
            
            $updateSucc = $this->machineModel->updateMachineModel($input,$id);
            if($updateSucc){
                if(!empty($imageData['attachments'])){
                    $rules = [
                        'attachment'=> 'required|mimes:jpeg,bmp,png,pdf,jpg'
                    ];
                    foreach ($imageData['attachments'] as $key => $value) {
                        $validation = Validator::make(['attachment'=>$value],$rules);
                        if($validation->passes()){
                            $data = [];
                            $data['machine_model_id'] = $id;
                            $data['file_name'] = 'null';
                            $drawingAtt = $this->machineModelAttachment->saveAttachment($data);
                            $fileName = Lib::uploadImage($value,Config::get('global_vars.PRODUCT_TYPE.DRAWING_ATTACHMENT_PRODUCT_TYPE'),$id,[],'MMA_'.$drawingAtt->id);
                            $update = [];
                            $update['file_name'] = $fileName;
                            $updateSucc = $this->machineModelAttachment->updateAttachment($update,$drawingAtt->id);
                        }
                    }
                }
            }
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
        return true;
    }

    public function updateMachine($update,$id)
    {
        $res = $this->machine->updateMachine($update,$id);
        return $res;
    }
    public function getMachineData()
    {
        $data['status'] = Lib::addSelect(Config::get('global_vars.STATUS_ARR'));
        $data['machineModel'] = Lib::addSelect($this->machineModel->getMachineModelList());
        $data['manufacturingUnit'] = Lib::addSelect($this->unit->getUnitList());
        return $data;
    }

    public function saveMachine($input)
    {
       return $this->machine->saveMachine($input);
        
    }

    public function deleteMachineModel($id)
    {
        
    }

    public function checkMachineModelDependancyForStore($storeId)
    {
        return $this->machineModel->getByStoreId($storeId);
    }

    public function checkMachineModelDependancyForAccount($manufacturerId)
    {
        return $this->machineModel->getByManufacturerId($manufacturerId);
    }

    public function checkMachineModelDependancyForType($typeId)
    {
        return $this->machineModel->getByTypeId($typeId);
    }

    public function deleteMachine($id)
    {
        return $this->machine->deleteMachine($id);
    }

    public function getMachineModelDataForExcel()
    {
        $data = [];
        $molds = $this->machineModel->getAllMachineModels();
        if(!empty($molds)){
            $supportData = $this->getMachineModelData();
            $keys = ['Id', 'Machine Model','Type','Store','Screw L D Ratio','Screw Diameter','Shot Wt Capacity','Plasticizing Capacity','Screw Speed','Injection Speed Max','Injection Pressure Max','Hold Pressure','Clamp Force','Clamp Stroke','Installed Heating Capacity','Dry Cycle Time','Hydraulic System Pressure','Oil Capacity','Net Weight','Manufacturer','Actuation','Connected Actuators 1','Connected Actuators 2','Status'];
            array_push($data, $keys);
            
            foreach ($molds as $key => $value) {
                unset($value['created_at']);
                unset($value['updated_at']);
                unset($value['deleted_at']);
                $value['status'] = $supportData['status'][$value['status']];
                $value['type_id'] = @$supportData['type'][$value['type_id']];
                $value['store_id'] = @$supportData['store'][$value['store_id']];
                $value['manufacturer_id'] = @$supportData['manufacturer'][$value['manufacturer_id']];
                $value['screw_l_d_ratio'] = @$supportData['screwRatio'][$value['screw_l_d_ratio']];
                $value['actuation_id'] = @$supportData['actuation'][$value['actuation_id']];
                $value['connected_actuators_1'] = @$supportData['actuation1'][$value['connected_actuators_1']];
                $value['connected_actuators_2'] = @$supportData['actuation2'][$value['connected_actuators_2']];
                array_push($data, $value);
            }
        }
        return $data;
        
    }

    public function getMachineDataForExcel()
    {
        $data = [];
        $molds = $this->machine->getAllMachines();
        if(!empty($molds)){
            $supportData = $this->getMachineData();
            $keys = ['Id', 'Molding Machine Name','Inhouse Serial No.','Manufacturer\'s Serial No.','Manufacturing Date','Molding Machine Inhouse Name','Downtime Allowance','Cleanup Downtime Allowance','Preventive Main. Downtime Allowance','Frequency','Machine Model','Manufacturing Unit','Status'];
            array_push($data, $keys);
            
            foreach ($molds as $key => $value) {
                unset($value['created_at']);
                unset($value['updated_at']);
                unset($value['deleted_at']);
                $value['manufacturing_unit'] = @$supportData['manufacturingUnit'][$value['manufacturing_unit']];
                $value['machine_model_id'] = @$supportData['machineModel'][$value['machine_model_id']];
                $value['status'] = $supportData['status'][$value['status']];
                array_push($data, $value);
            }
        }
        return $data;
        
    }
}
