<?php

namespace ksec\Http\Requests;

use ksec\Http\Requests\Request;

class EmployeeRequest extends Request
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
                    'empCode' => 'required|unique:employees,emp_code',
                    'systemId' => 'required|unique:employees,system_id',
                    'empName' => 'required|max:100',
                    'mobile' => 'required|unique:employees,mobile|size:10',
                    'email' => 'required|email',
                    'managerId' => 'exists:employees,id,status,A',
                    'teamleadId' => 'exists:employees,id,status,A',
                    'empType' => 'required|exists:emp_types,id,status,A',
                    'password' => 'required|between:6,20',
                    'profile' => 'required|exists:profiles,id',
                    'status' => 'required|in:A,I',
                    'city' => 'required|exists:cities',
                    'allowLogin' => 'required|in:Y,N',
                    'department' => 'required|exists:departments,id,status,A',

                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'empCode' => 'required|unique:employees,emp_code,'.$this->route()->getParameter('employees').'id',
                    'systemId' => 'required|unique:employees,system_id,'.$this->route()->getParameter('employees').'id',
                    'empName' => 'required|max:100',
                    'mobile' => 'required|unique:employees,mobile,'.$this->route()->getParameter('employees').'id,|size:10',
                    'email' => 'required|email',
                    'managerId' => 'exists:employees,id,status,A',
                    'teamleadId' => 'exists:employees,id,status,A',
                    'empType' => 'required|exists:emp_types,id,status,A',
                    'profile' => 'required|exists:profiles,id',
                    'status' => 'required|in:A,I',
                    'city' => 'required|exists:cities,id',
                    'allowLogin' => 'required|in:Y,N',
                    'department' => 'required|exists:departments,id,status,A',
                ];
            }
            default:break;
        }
    }
}
