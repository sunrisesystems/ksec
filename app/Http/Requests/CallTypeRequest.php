<?php

namespace ksec\Http\Requests;

use ksec\Http\Requests\Request;

class CallTypeRequest extends Request
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

                    'callType' => 'required|unique:call_types,call_type,NULL,id,deleted_at,NULL',
                    'status' => 'required|in:A,I',
                    'description' => 'required',
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
