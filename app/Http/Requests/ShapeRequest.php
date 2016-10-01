<?php

namespace ksec\Http\Requests;

use ksec\Http\Requests\Request;

class ShapeRequest extends Request
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
                    'shape_name' => 'required|alpha|unique:bottle_shapes,shape_name,NULL,id,deleted_at,NULL',
                    'shape_code'  => 'required|unique:bottle_shapes,shape_code,NULL,id,deleted_at,NULL',
                    'status' => 'required|in:A,I',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'shape_name' => 'required|alpha|unique:bottle_shapes,shape_name,'.$this->route()->getParameter('shapes').',id,deleted_at,NULL',
                    'shape_code'  => 'required|unique:bottle_shapes,shape_code,'.$this->route()->getParameter('shapes').',id,deleted_at,NULL',
                    'status' => 'required|in:A,I',
                    
                ];
            }
            default:break;
        }
    }
}
