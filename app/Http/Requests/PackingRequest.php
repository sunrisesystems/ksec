<?php

namespace ksec\Http\Requests;

use ksec\Http\Requests\Request;

class PackingRequest extends Request
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
                return  [
                    'qty_per_box' => 'required|numeric',
                    'product_id' => 'required|exists:products,id,status,A',
                    'box_type' => 'required|exists:items,id,status,A',
                    'type_of_packing' => 'required|exists:code_values,id',
                    'status' => 'required|in:A,I',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'qty_per_box' => 'required|numeric',
                    'product_id' => 'required|exists:products,id,status,A',
                    'box_type' => 'required|exists:items,id,status,A',
                    'type_of_packing' => 'required|exists:code_values,id',
                    'status' => 'required|in:A,I',
                ];
            }
            default:break;
        }
    }
}
