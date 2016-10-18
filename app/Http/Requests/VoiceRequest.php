<?php

namespace ksec\Http\Requests;

use ksec\Http\Requests\Request;
use Config;


class VoiceRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'date' => 'required|date_format:d-M-Y',
                    'process' => 'required|exists:processes,id,status,A',
                    'agent' => 'required|exists:employees,id,status,A,emp_type_id,'.Config::get("global_vars.HARD_CODED_ID.agent"),
                    'teamLead' => 'required|exists:employees,id,status,A,emp_type_id,'.Config::get("global_vars.HARD_CODED_ID.teamLead"),
                    'manager' => 'required|exists:employees,id,status,A,emp_type_id,'.Config::get("global_vars.HARD_CODED_ID.managerId"),
                    'category' => 'required|exists:code_values,id,status,A,code_id,'.Config::get("global_vars.HARD_CODED_ID.employeeCategory"),
                    'clientId' => 'required',
                    'callId' => 'required',
                    'duration' => 'required|exists:code_values,id,status,A,code_id,'.Config::get("global_vars.HARD_CODED_ID.callDuration"),
                    'callType' => 'required|exists:call_types,id,status,A',
                    'subCallType' => 'required|exists:call_types_sub,id,status,A',
                    'fatalReason1' => 'exists:code_values,id,status,A,code_id,'.Config::get("global_vars.HARD_CODED_ID.fatalReason"),
                    'fatalReason2' => 'exists:code_values,id,status,A,code_id,'.Config::get("global_vars.HARD_CODED_ID.fatalReason"),
                    'fatalComment' => 'required_with:fatalReason1,fatalReason2',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'callType' => 'required|unique:call_types,call_type,'.$this->route()->getParameter('calltype').',id,deleted_at,NULL',
                    'status' => 'required|in:A,I',
                    'description' => 'required',
                ];
            }
            default:break;
        }
    }
}
