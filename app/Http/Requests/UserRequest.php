<?php

namespace ksec\Http\Requests;

use ksec\Http\Requests\Request;

class UserRequest extends Request
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
                    'unit' => 'required|exists:units,id',
                    'firstname' => 'required|alpha',
                    'lastname' => 'required|alpha',
                    'email' => 'email|unique:users,email,NULL,id,deleted_at,NULL',
                    'username' => 'required|between:5,15|unique:users,username,NULL,id,deleted_at,NULL',
                    'password' => 'required|between:6,15',
                    'role' => 'required|exists:roles,id',
                    'status' => 'required|in:A,I',

                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'unit_id' => 'required|exists:units,id',
                    'first_name' => 'required|alpha',
                    'last_name' => 'required|alpha',
                    'email' => 'email|unique:users,email,'.$this->route()->getParameter('users').',id,deleted_at,NULL',
                    'username' => 'required|between:5,15|unique:users,username,'.$this->route()->getParameter('users').',id,deleted_at,NULL',
                    'role' => 'required|exists:roles,id',
                    'status' => 'required|in:A,I', 
                ];
            }
            default:break;
        }
    }
}
