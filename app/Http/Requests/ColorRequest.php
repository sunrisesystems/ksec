<?php

namespace ksec\Http\Requests;

use ksec\Http\Requests\Request;

class ColorRequest extends Request
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
                    'color' => 'required|unique:colors,color,NULL,id,deleted_at,NULL',
                    'status' => 'required|in:A,I',

                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'color' => 'required|unique:colors,color,'.$this->route()->getParameter('colors').',id,deleted_at,NULL',
                    'status' => 'required|in:A,I',
                    
                ];
            }
            default:break;
        }
    }
}
