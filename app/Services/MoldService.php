<?php namespace ksec\Services;

use ksec\Drawing;
use ksec\Type;
use ksec\Store;
use ksec\Group;
use ksec\Mold;
use ksec\Unit;
use ksec\CodeValue;
use ksec\Account;
use Request,Config,DB,Validator;
use ksec\Libraries\Lib;
use Lang,Sentinel;

class MoldService {

    public function __construct(Drawing $drawing,
                                Type $type,
                                Store $store,
                                Group $group,
                                Account $account,
                                Mold $mold,
                                Unit $unit,
                                CodeValue $codeValue)
    {
        $this->drawing = $drawing;
        $this->codeValue = $codeValue;
        $this->type = $type;
        $this->group = $group;
        $this->store = $store;
        $this->account = $account;
        $this->mold = $mold;
        $this->unit = $unit;
    }
    

    public function getAllData()
    {
        $data = [];
        $data['type'] = Lib::addSelect($this->type->getTypeListByGroupId(Config::get('global_vars.HARD_CODED_ID.MOLD_GROUP_ID')));
        $data['store'] = Lib::addSelect($this->store->getStoreList());
        $data['drawing'] = Lib::addSelect($this->drawing->getDrawingList());
        $data['manufacturer'] = Lib::addSelect($this->account->getVendorTypeAccountList());
        $data['unit'] = Lib::addSelect($this->unit->getUnitList());
        $data['status'] = Lib::addSelect(Config::get('global_vars.STATUS_ARR'));
        $data['priority'] = Lib::addSelect(Config::get('global_vars.PRIORITY_ARR'));
        $data['motherMold'] = Lib::addSelect($this->codeValue->getDataByCodeId(Config::get("global_vars.CODE_ID.mother_mold")));
        $data['blowMold'] = Lib::addSelect($this->codeValue->getDataByCodeId(Config::get("global_vars.CODE_ID.blow_mold")));
        $data['injectionMold'] = Lib::addSelect($this->codeValue->getDataByCodeId(Config::get("global_vars.CODE_ID.injection_mold")));

        return $data;
    } 

    public function saveMold($input)
    {
        $result = [];
        //  check for mold combination
        $data['mother_mold'] = $input['mother_mold'];
        $data['blow_mold'] = $input['blow_mold'];
        $data['injection_mold'] = $input['injection_mold'];

        $alreadyExists = $this->mold->checkMolds($data);
        if($alreadyExists){
            $result['success'] = 0;
            $result['msg'] = Lang::get('messages.combination_already_exists');
        }else{
            $this->mold->saveMold(Lib::trimInput($input));
            $result['success'] = 1;
        }
        return $result;
    } 

    public function getMolds($input)
    {
        $input['unitId'] = Sentinel::getUser()->unit_id;
        $input['paginationLimit'] = Config::get("global_vars.PAGINATION_LIMIT");
        $molds = $this->mold->getMolds($input);
        return $molds;
    }
 
    public function getMold($id)
    {
        return $this->mold->getMoldById($id);
    } 

    public function updateMold($update,$id)
    {
        $result = [];
        //  check for mold combination
        $data['mother_mold'] = $update['mother_mold'];
        $data['blow_mold'] = $update['blow_mold'];
        $data['injection_mold'] = $update['injection_mold'];

        $alreadyExists = $this->mold->checkMolds($data,$id);
        if($alreadyExists){
            $result['success'] = 0;
            $result['msg'] = Lang::get('messages.combination_already_exists');
        }else{
            $this->mold->updateMold($update,$id);
            $result['success'] = 1;
        }
        return $result;
    }          

    public function deleteMold($id)
    {
        return $this->mold->deleteMold($id);     
    }

    public function checkDependancyForStore($storeId)
    {
        return $this->mold->getByStoreId($storeId);
    }

    public function checkDependancyForAccount($manufacturerId)
    {
        return $this->mold->checkForAccount($manufacturerId);
    }

    public function checkDependancyForType($typeId)
    {
        return $this->mold->checkByTypeId($typeId);
    }

    public function getDataForExcel()
    {
        $data = [];
        $molds = $this->mold->getAllMolds();
        if(!empty($molds)){
            $supportData = $this->getAllData();
            $keys = ['Id', 'Mold Name','Type','Store','Mold No','Drawing','Hot Runner Capacity Center','Mold Temp Control Zone Center','Weighted Avg Wt','Manufacturer','Status','Manufacting Unit','Priority','Mother Mold','Blow Mold','Injection Mold'];
            array_push($data, $keys);
            
            foreach ($molds as $key => $value) {
                unset($value['created_at']);
                unset($value['updated_at']);
                unset($value['deleted_at']);
                unset($value['drawing_file']);
                $value['status'] = $supportData['status'][$value['status']];
                $value['type_id'] = @$supportData['type'][$value['type_id']];
                $value['store_id'] = @$supportData['store'][$value['store_id']];
                $value['drawing_id'] = @$supportData['drawing'][$value['drawing_id']];
                $value['manufacturer_id'] = @$supportData['manufacturer'][$value['manufacturer_id']];
                $value['unit_id'] = @$supportData['unit'][$value['unit_id']];
                $value['priority'] = @$supportData['priority'][$value['priority']];
                $value['injection_mold'] = @$supportData['injectionMold'][$value['injection_mold']];
                $value['blow_mold'] = @$supportData['blowMold'][$value['blow_mold']];
                $value['mother_mold'] = @$supportData['motherMold'][$value['mother_mold']];
                array_push($data, $value);
            }
        }
        return $data;
        
    }
}