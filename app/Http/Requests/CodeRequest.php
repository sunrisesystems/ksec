<?php

namespace ksec\Http\Requests;

use ksec\Http\Requests\Request;

class CodeRequest extends Request
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
                return [
                    //'type' => 'required|exists:types,type',
                ];
            }
            case 'POST':
            {
                return [
                    'code_id' =>'required|exists:code,id',
                    'code_value' => 'required|unique:code_values,code_value,NULL,id,deleted_at,NULL,code_id,'.$this->input('code_id'),
                    'status' => 'required|in:A,I',
                    'description' => 'required|unique:code_values,description,NULL,id,deleted_at,NULL',

                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'code_id' =>'required|exists:code,id',
                    'code_value' => 'required|unique:code_values,code_value,'.$this->route()->getParameter('codeValue').',id,deleted_at,NULL,code_id,'.$this->input('code_id'),
                    'status' => 'required|in:A,I',
                    'description' => 'required|unique:code_values,description,'.$this->route()->getParameter('codeValue').',id,deleted_at,NULL',
                    
                ];
            }
            default:break;
        }
    }
}
