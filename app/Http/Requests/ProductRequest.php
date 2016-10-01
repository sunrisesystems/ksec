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
                    'trade_name' => 'required|unique:products,trade_name,NULL,id,deleted_at,NULL',
                     'type_id' => 'required|exists:types,id',
                    'group_id' => 'required|exists:groups,id',
                    'store_id' => 'required|exists:classes,id',
                    'drawing_id' => 'required|exists:drawings,id',
                    'color_id' => 'required|exists:colors,id',
                    'brand_id' => 'required|exists:code_values,id',
                    'status' => 'required|in:A,I',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'trade_name' => 'required|unique:products,trade_name,'.$this->route()->getParameter('product').',id,deleted_at,NULL',
                    'type_id' => 'required|exists:types,id',
                    'group_id' => 'required|exists:groups,id',
                    'store_id' => 'required|exists:classes,id',
                    'drawing_id' => 'required|exists:drawings,id',
                    'color_id' => 'required|exists:colors,id',
                    'brand_id' => 'required|exists:code_values,id',
                    'status' => 'required|in:A,I',
                    
                ];
            }
            default:break;
        }
    }
}
