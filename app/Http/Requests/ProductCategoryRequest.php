<?php

namespace ksec\Http\Requests;

use ksec\Http\Requests\Request;

class ProductCategoryRequest extends Request
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

                    'name' => 'required|unique:product_categories,name',
                    'status' => 'required|in:A,I',
                    'description' => 'required',
                    'product' => 'required|exists:products,id,status,A',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                     'name' => 'required|unique:product_categories,name,'.$this->route()->getParameter('product_category').',id',
                    'status' => 'required|in:A,I',
                    'description' => 'required',
                    'product' => 'required|exists:products,id,status,A',
                ];
            }
            default:break;
        }
    }
}
