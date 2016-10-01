<?php

namespace ksec\Http\Requests;

use ksec\Http\Requests\Request;

class StoreRequest extends Request
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
                    'class' => 'required|unique:classes,class,NULL,id,deleted_at,NULL',
                    'status' => 'required|in:A,I',

                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'class' => 'required|unique:classes,class,'.$this->route()->getParameter('stores').',id,deleted_at,NULL',
                    'status' => 'required|in:A,I',
                    
                ];
            }
            default:break;
        }
    }
}
