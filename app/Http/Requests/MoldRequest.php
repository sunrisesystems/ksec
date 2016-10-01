<?php

namespace ksec\Http\Requests;

use ksec\Http\Requests\Request;

class MoldRequest extends Request
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
                    'mold_name' => 'required|unique:molds,mold_name,NULL,id,deleted_at,NULL',
                    'type_id' => 'required|integer|exists:types,id',
                    'store_id' => 'required|integer|exists:classes,id',
                    'mold_no' => 'required|unique:molds,mold_no,NULL,id,deleted_at,NULL',
                    'drawing_id' => 'required|integer|exists:drawings,id',
                    'manufacturer_id' => 'required|exists:accounts,id',
                   // 'hot_runner_capacity_l' => 'required',
                    'hot_runner_capacity_c' => 'required',
                   // 'hot_runner_capacity_h' => 'required',
                   // 'mold_temp_control_zone_l' => 'required',
                    'mold_temp_control_zone_c' => 'required',
                    //'mold_temp_control_zone_h' => 'required',
                    'status' => 'required|in:A,I',
                    'unit_id' => 'required|exists:units,id',
                    'priority' => 'required|in:P,S',
                    'weighted_avg_wt' => 'required',
                    'mother_mold' => 'required|exists:code_values,id',
                    'blow_mold' => 'required|exists:code_values,id',
                    'injection_mold' => 'required|exists:code_values,id',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'mold_name' => 'required|unique:molds,mold_name,'.$this->route()->getParameter('mold').',id,deleted_at,NULL',
                    'mold_name' => 'required|unique:molds,mold_name,'.$this->route()->getParameter('mold').',id,deleted_at,NULL',
                    'mold_name' => 'required|unique:molds,mold_name,'.$this->route()->getParameter('mold').',id,deleted_at,NULL',
                    'type_id' => 'required|integer|exists:types,id',
                    'store_id' => 'required|integer|exists:classes,id',
                    'mold_no' => 'required|unique:molds,mold_no,'.$this->route()->getParameter('mold').',id,deleted_at,NULL',
                    'drawing_id' => 'required|integer|exists:drawings,id',
                    'manufacturer_id' => 'required|exists:accounts,id',
                   // 'hot_runner_capacity_l' => 'required',
                    'hot_runner_capacity_c' => 'required',
                    //'hot_runner_capacity_h' => 'required',
                    //'mold_temp_control_zone_l' => 'required',
                    'mold_temp_control_zone_c' => 'required',
                    //'mold_temp_control_zone_h' => 'required',
                    'status' => 'required|in:A,I',
                    'unit_id' => 'required|exists:units,id',
                     'priority' => 'required|in:P,S',
                    'weighted_avg_wt' => 'required',
                     'mother_mold' => 'required|exists:code_values,id',
                    'blow_mold' => 'required|exists:code_values,id',
                    'injection_mold' => 'required|exists:code_values,id',
                ];
            }
            default:break;
        }
    }
}
