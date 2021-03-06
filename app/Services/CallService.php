<?php 
namespace ksec\Services;

use Lib,Config,Lang;
use ksec\CallType;
use ksec\CallTypeSub;

class CallService {

    public function __construct(CallType $callType,
                                CallTypeSub $subCallType)
    {
        $this->callType = $callType;  
        $this->subCallType = $subCallType;
	}

    public function getCallTypeAllData()
    {
        $data['status'] = Lib::addSelect(Config::get('global_vars.STATUS_ARR'));
        return $data;
    }  

    public function saveCallType($input)
    {
        try {
            $response = [
                'success' => 0,
                'data' => Lang::get("messages.PROCESS_FAIL"),
            ]; 

            $insert = [
                'call_type' => $input['callType'],
                'status' => $input['status'],
                'description' => $input['description'],
            ];
            $insertRes = $this->callType->saveCallType($insert);
            if(count($insertRes)){
                $response = [
                    'success' => 1,
                ];
            }
        } catch (Exception $e) {
             
        }finally{
            return $response;
        } 
    }

    public function getCallTypeById($id)
    {
        return $this->callType->getCallTypeById($id);
    }

    public function updateCallType($input,$id)
    {
        try {
            $response = [
                'success' => 0,
                'data' => Lang::get('messages.PROCESS_FAIL'),
            ];

            $update = [
                'call_type' => $input['callType'],
                'status' => $input['status'],
                'description' => $input['description'],
            ];
            $updateSucc = $this->callType->updateCallType($update,$id);
            if($updateSucc){
                $response = [
                    'success' => 1,
                ];
            }
        } catch (Exception $e) {
            
        }finally{
            return $response;
        }
    }

    public function getCallTypes($input)
    {
        $input['limit'] = Config::get('global_vars.PAGINATION_LIMIT');

        return $this->callType->getCallTypes($input);
    }

    public function getCallSubTypeByCallId($callTypeId)
    {
        try {
            $response = [
                'success' => 0,
                'data' => Lang::get('messages.PROCESS_FAIL'),
            ];

            // subtype list
            $subCallTypes = $this->subCallType->getSubCallTypeByCallId($callTypeId);
            if(!empty($subCallTypes)){
                $response = [
                    'success' => 1,
                    'data' => Lib::addSelect($subCallTypes),
                ];
            }else{
                $response['data'] = [];
            }
        } catch (Exception $e) {
            
        }finally{
            return $response;
        }
    }
    
}