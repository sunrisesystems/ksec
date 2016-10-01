<?php

namespace ksec\Http\Requests;

use ksec\Http\Requests\Request;

class ItemRequest extends Request
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
                    'name' => 'required|unique:items,name,NULL,id,deleted_at,NULL',
                    'short_desc' => 'required|unique:items,short_desc,NULL,id,deleted_at,NULL',
                    'type_id' => 'required|exists:types,id,group_id,'.$this->input('group_id'),
                    'group_id' => 'required|exists:groups,id',
                    'store_id' => 'required|exists:classes,id',
                    'status' => 'required|in:A,I',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required|unique:items,name,'.$this->route()->getParameter('item').',id,deleted_at,NULL',
                    'short_desc' => 'required|unique:items,short_desc,'.$this->route()->getParameter('item').',id,deleted_at,NULL',
                    'type_id' => 'required|exists:types,id,group_id,'.$this->input('group_id'),
                    'group_id' => 'required|exists:groups,id',
                    'store_id' => 'required|exists:classes,id',
                    'status' => 'required|in:A,I',
                ];
            }
            default:break;
        }
    }
}
