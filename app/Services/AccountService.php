<?php namespace ksec\Services;

use ksec\AccountType;
use ksec\Account;
use Request,Config,DB,Lang;
use ksec\Libraries\Lib;
use ksec\Services\MoldService;
use ksec\Services\DrawingService;
use ksec\Services\MachineService;

class AccountService {

    public function __construct(AccountType $accountType,
                                Account $account,
                                DrawingService $drawingService,
                                MoldService $moldService,
                                MachineService $machineService)
    {
        $this->accountType = $accountType;
        $this->machineService = $machineService;
        $this->account = $account;
        $this->drawingService = $drawingService;
        $this->moldService = $moldService;
    }
    
    public function saveAccount($input)
    {
        $input['account_type_id'] = 2;

        $input = Lib::trimInput($input);

        return $this->account->saveAccount($input);
    }

    public function getAccountType()
    {
        return Lib::addSelect($this->accountType->getAccountTypeList());
    }  


    public function getAccounts($input)
    {
        $input = Lib::trimInput($input);
        $input['paginationLimit'] = Config::get("global_vars.PAGINATION_LIMIT");
        $accounts = $this->account->getAccounts($input);
        return $accounts;
    }  

    public function getAccount($id)
    {
        return $this->account->getAccountById($id);
    }  

    public function updateAccount($update,$id)
    {
        $update['account_type_id'] = 2;

        $update = Lib::trimInput($update);
        return $this->account->updateAccount($update,$id);
    } 

    public function deleteAccount($id)
    {
        $result['success'] = 0;
        /* dependancy check on drawing,machine model and mold */
        $machineModel = $this->machineService->checkMachineModelDependancyForAccount($id);
        if($machineModel){
            $result['data'] = Lang::get('messages.MACHINE_MODEL_ACCOUNT_DEPENDANCY');
            return $result;
        }
        $mold = $this->drawingService->checkDependancyForAccount($id);
        if($mold){
            $result['data'] = Lang::get('messages.DRAWING_ACCOUNT_DEPENDANCY');
            return $result;
        }
        $product = $this->moldService->checkDependancyForAccount($id);
        if($product){
            $result['data'] = Lang::get('messages.MOLD_ACCOUNT_DEPENDANCY');
            return $result;
        }
        $this->account->deleteAccount($id);
        $result['success'] = 1;
        return $result;   
    }     
}