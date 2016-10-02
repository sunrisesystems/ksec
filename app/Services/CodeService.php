<?php 
namespace ksec\Services;

use ksec\Code;
use ksec\CodeValue;
use Request,Config,Lang;
use ksec\Libraries\Lib;

class CodeService {

    public function __construct(Code $code,
                                CodeValue $codeValue)
    {
        $this->code = $code;
        $this->codeValue = $codeValue;
	}

    public function getData()
    {
        $data['code'] = Lib::addSelect($this->code->getCodeList());
        $data['status'] = Lib::addSelect(Config::get('global_vars.STATUS_ARR'));
        return $data;
    } 

    public function saveCodeValue($input){
        $input = Lib::trimInput($input);
        return $this->codeValue->saveCodeValue($input);
    }
    
    public function getCodeValues($input){
        $input = Lib::trimInput($input);
        $input['paginationLimit'] = Config::get("global_vars.PAGINATION_LIMIT");
        $codeValues = $this->codeValue->getCodeValues($input);
        return $codeValues;
    }

    public function getCodeValue($id)
    {
        return $this->codeValue->getById($id);
    }
                                                                                                                           
    public function updateCodeValue($update,$id){
        $update = Lib::trimInput($update);
        return $this->codeValue->updateCodeValue($update,$id);
    }  

    public function deleteCodeValue()
    {
       
    }                                                                                                                   
}