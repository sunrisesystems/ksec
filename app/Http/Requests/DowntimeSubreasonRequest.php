<?php

namespace ksec\Http\Requests;

use ksec\Http\Requests\Request;

class DowntimeSubreasonRequest extends Request
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
                    'downtime_reason_id' => 'required|exists:downtime_reasons,id',
                    'subreason' => 'required|unique:downtime_subreasons,subreason,NULL,id,deleted_at,NULL',
                    'status' => 'required|in:A,I',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'downtime_reason_id' => 'required|exists:downtime_reasons,id', 
                    'subreason' => 'required|unique:downtime_subreasons,subreason,'.$this->route()->getParameter('downtime').',id,deleted_at,NULL',
                    'status' => 'required|in:A,I',
                    
                ];
            }
            default:break;
        }
    }
}
