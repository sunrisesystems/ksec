<?php

namespace ksec\Http\Requests;

use ksec\Http\Requests\Request;

class ProductRequest extends Request
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

                    'productName' => 'required|unique:products,name,NULL,id,deleted_at,NULL',
                    'status' => 'required|in:A,I',
                    'description' => 'required',
                    'department' => 'required|array',
                    'employee' => 'required|array',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'productName' => 'required|unique:products,name,'.$this->route()->getParameter('products').',id,deleted_at,NULL',
                    'status' => 'required|in:A,I',
                    'description' => 'required',
                    'department' => 'required|array',
                    'employee' => 'required|array',
                    
                ];
            }
            default:break;
        }
    }
}
