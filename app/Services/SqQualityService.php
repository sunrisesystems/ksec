<?php namespace ksec\Services;

use Request,Config,DB,Validator;
use Lib,Lang;
use ksec\SqScorematrix;

class SqQualityService {

    public function __construct(SqScorematrix $sqScorematrix)
    {
        $this->sqScorematrix = $sqScorematrix;   
	}   

    public function getQualityParameters($formName,$columnName)
    {
        try {
            $response = [
                'success' => 0,
                'data' => Lang::get("messages.PROCESS_FAIL"),
            ];
            $sqParamList = $sqParamDetails = [];

            $sqParams = $this->sqScorematrix->getSqParamters($formName,$columnName);
            if(count($sqParams)){
                foreach ($sqParams as $key => $value) {
                    $sqParamList[$value->score] = $value->score;
                    $sqParamDetails[$value->score]['maxscore'] = $value->maxscore;      
                    $sqParamDetails[$value->score]['achscore'] = $value->achscore;      
                }
            }
            if(!empty($sqParamList)){
                $data['list'] = $sqParamList;
                $data['details'] = $sqParamDetails;
                $response = [
                    'success' =>1,
                    'data'=>$data,
                ];
            }

        } catch (Exception $e) {
            
        }finally{
            return $response;
        }
    }
}