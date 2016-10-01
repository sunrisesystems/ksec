<?php namespace ksec\Services;

use ksec\DefectNature as DefectNature;
use ksec\DefectReason as DefectReason;
use ksec\Defect as Defect;
use Request,Config,Lang;
use ksec\Libraries\Lib;

class DefectService {

    public function __construct(DefectNature $defectNature,
                                DefectReason $defectReason,
                                Defect $defect)
    {
        $this->defectNature = $defectNature;
        $this->defect = $defect;
        $this->defectReason = $defectReason;
	}

        
    public function getData(){
        $data['defectReason'] = Lib::addSelect($this->defectReason->getDefectReasonList());
        $data['defectNature'] = Lib::addSelect($this->defectNature->getDefectNatureList());
        $data['status'] = Lib::addSelect(Config::get('global_vars.STATUS_ARR'));
        $data['ccb'] = Lib::addSelect(Config::get('global_vars.CCB'));
        return $data;
    }    

    public function saveDefect($input){
        $result['success'] = 0;
        $save = $this->defect->saveDefect(Lib::trimInput($input));
        if(count($save)){
            $result['success'] = 1;
        }else{
            $result['msg'] = Lang::get("messages.ERROR");
        }
        return $result;
    }

    public function getDefects($input){
        $input = Lib::trimInput($input);
        $input['paginationLimit'] = Config::get("global_vars.PAGINATION_LIMIT");
        $molds = $this->defect->getDefects($input);
        return $molds;
    } 

    public function getDefectById($id){
        return $this->defect->getDefectById($id);
    }                         

    public function updateDefect($update,$id){
        $result['success'] = 0;
        $update = Lib::trimInput($update);
        $updateSucc = $this->defect->updateDefect($update,$id);
        if($updateSucc){
            $result['success'] = 1;
        }else{
            $result['msg'] = Lang::get("messages.ERROR");
        }
        return $result;
    }                                            

    public function deleteDefect($id){
        return $this->defect->deleteDefect($id);
    } 

    public function getDefectDataForExcel()
    {
        $data = [];
        $downtime = $this->defect->getAllDefects();
        if(!empty($downtime)){
            $supportData = $this->getData();
            $keys = ['Id', 'Defect Nature','Defect Reason','Defect','Status','Cause Cavity Block'];
            array_push($data, $keys);
            
            foreach ($downtime as $key => $value) {
                unset($value['created_at']);
                unset($value['updated_at']);
                unset($value['deleted_at']);
                $value['defect_nature_id'] = @$supportData['defectNature'][$value['defect_nature_id']];
                $value['defect_reason_id'] = @$supportData['defectReason'][$value['defect_reason_id']];
                $value['ccb'] = @$supportData['ccb'][$value['ccb']];
                $value['status'] = $supportData['status'][$value['status']];
                array_push($data, $value);
            }
        }
        return $data;
    }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
}