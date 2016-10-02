<?php

namespace cvmapp\Http\Requests;

use cvmapp\Http\Requests\Request;

class ProductSubcategoryRequest extends Request
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

                    'name' => 'required|unique:product_subcategories,name',
                    'status' => 'required|in:A,I',
                    'description' => 'required',
                    'productCategory' => 'required|exists:product_categories,id,status,A',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required|unique:product_subcategories,name,'.$this->route()->getParameter('product_subcategory').',id',
                    'status' => 'required|in:A,I',
                    'description' => 'required',
                    'productCategory' => 'required|exists:product_categories,id,status,A',
                ];
            }
            default:break;
        }
    }
}
