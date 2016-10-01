<?php

namespace ksec\Http\Requests;

use ksec\Http\Requests\Request;

class MachinRequest extends Request
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
                    'molding_machine_name' => 'required|unique:machines,molding_machine_name,NULL,id,deleted_at,NULL',
                    'inhouse_serial_no' => 'required',
                    'manufacturer_serial_no' => 'required',
                    'manufacturing_date' => 'required',
                    'molding_machine_inhouse_name' => 'required',
                    'downtime_allowance' => 'required',
                    'cleanup_downtime_allowance' => 'required',
                    'maintenance_downtime_allowance' => 'required',
                    'downtime_frequency' => 'required',
                    'machine_model_id'=>'required',
                    'manufacturing_unit' => 'required',
                    'status' => 'required|in:A,I',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'machine_model' => 'required|unique:machines,molding_machine_name,'.$this->route()->getParameter('machine').',id,deleted_at,NULL',
                    'inhouse_serial_no' => 'required',
                    'manufacturer_serial_no' => 'required',
                    'manufacturing_date' => 'required',
                    'molding_machine_inhouse_name' => 'required',
                    'downtime_allowance' => 'required',
                    'cleanup_downtime_allowance' => 'required',
                    'maintenance_downtime_allowance' => 'required',
                    'downtime_frequency' => 'required',
                    'machine_model_id'=>'required',
                    'manufacturing_unit' => 'required',
                    'status' => 'required|in:A,I',
                ];
            }
            default:break;
        }
    }
}
