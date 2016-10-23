<?php

namespace ksec\Http\Requests;

use ksec\Http\Requests\Request;
use Config,Lib,Lang;


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
                $rules =  [
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
                    'knowledge' => 'required|in:Yes,No,NA',
                    'securityVerification' => 'required|in:Yes,No,NA',
                    'callBackSeverity' => 'required|in:Yes,No,NA',
                    'adherenceOther' => 'required|in:Yes,No,NA',
                    'tm' => 'required',
                    'cm' => 'required',
                    'chp' => 'required',
                    'poa' => 'required',
                    'delighter' => 'required',
                    'su' => 'required',
                    'sct' => 'required',
                    'ocr' => 'required',
                    'pg' => 'required',
                    'osat' => 'required',
                    'rsat' => 'required',
                    'appreciation' => 'required',
                ];
                
                if($this->input('knowledge') == 'No' || $this->input('securityVerification') == 'No' || $this->input('callBackSeverity') == 'No' || $this->input('adherenceOther') == 'No'){
                    $rules['adherenceComment'] = 'required';
                }

                return $rules;
            }
            case 'PUT':
            case 'PATCH':
            {
                $rules =  [
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
                    'knowledge' => 'required|in:Yes,No,NA',
                    'securityVerification' => 'required|in:Yes,No,NA',
                    'callBackSeverity' => 'required|in:Yes,No,NA',
                    'adherenceOther' => 'required|in:Yes,No,NA',
                    'tm' => 'required',
                    'cm' => 'required',
                    'chp' => 'required',
                    'poa' => 'required',
                    'delighter' => 'required',
                    'su' => 'required',
                    'sct' => 'required',
                    'ocr' => 'required',
                    'pg' => 'required',
                    'osat' => 'required',
                    'rsat' => 'required',
                    'appreciation' => 'required',
                ];
                
                if($this->input('knowledge') == 'No' || $this->input('securityVerification') == 'No' || $this->input('callBackSeverity') == 'No' || $this->input('adherenceOther') == 'No'){
                    $rules['adherenceComment'] = 'required';
                }

                return $rules;
            }
            default:break;
        }
    }

    public function messages()
    {
        return [
            'adherenceComment.required' => Lang::get('messages.adherence_comment'),
            'tm.required' => Lang::get('messages.tm_required'),
            'cm.required' => Lang::get('messages.cm_required'),
            'chp.required' => Lang::get('messages.chp_required'),
            'su.required' => Lang::get('messages.su_required'),
            'sct.required' => Lang::get('messages.sct_required'),
            'delighter.required' => Lang::get('messages.delighter_required'),
            'poa.required' => Lang::get('messages.poa_required'),
            'pg.required' => Lang::get('messages.pg_required'),
        ];
    }
}
