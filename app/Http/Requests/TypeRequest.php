<?php

namespace ksec\Http\Requests;

use ksec\Http\Requests\Request;

class TypeRequest extends Request
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
                    'group_id' =>'exists:groups,id',
                    'type' => 'required|unique:types,type,NULL,id,deleted_at,NULL',
                    'status' => 'required|in:A,I',

                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'group_id' =>'exists:groups,id',
                    'type' => 'required|unique:types,type,'.$this->route()->getParameter('types').',id,deleted_at,NULL',
                    'status' => 'required|in:A,I',
                    
                ];
            }
            default:break;
        }
    }
}
