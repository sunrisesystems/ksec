<?php

namespace ksec\Http\Requests;

use ksec\Http\Requests\Request;

class MachineModelRequest extends Request
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
                    'machine_model' => 'required|unique:machine_models,machine_model,NULL,id,deleted_at,NULL',
                    'type_id' => 'required|integer|exists:types,id',
                    'store_id' => 'required|integer|exists:classes,id',
                    'screw_l_d_ratio' => 'required|integer|exists:code_values,id',
                    'screw_diameter' => 'required',
                    'shot_wt_capacity' => 'required',
                    'plasticizing_capacity' => 'required',
                    'screw_speed' => 'required',
                    'injection_speed_max' => 'required',
                    'injection_pressure_max' => 'required',
                    'hold_pressure' => 'required',
                    'clamp_force' => 'required',
                    'clamp_stroke' => 'required',
                    'installed_heating_capacity' => 'required',
                    'dry_cycle_time' => 'required',
                    'hydraulic_system_pressure' => 'required',
                    'oil_capacity' => 'required',
                    'net_weight' => 'required',
                    'manufacturer_id' => 'required|integer|exists:accounts,id',
                    'actuation_id' => 'required|integer|exists:code_values,id',
                    'connected_actuators_1' => 'required|integer|exists:code_values,id',
                    'connected_actuators_2' => 'integer|exists:code_values,id',
                    'status' => 'required|in:A,I',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'machine_model' => 'required|unique:machine_models,machine_model,'.$this->route()->getParameter('machineModel').',id,deleted_at,NULL',
                    'type_id' => 'required|integer|exists:types,id',
                    'store_id' => 'required|integer|exists:classes,id',
                    'screw_l_d_ratio' => 'required|integer|exists:code_values,id',
                    'screw_diameter' => 'required',
                    'shot_wt_capacity' => 'required',
                    'plasticizing_capacity' => 'required',
                    'screw_speed' => 'required',
                    'injection_speed_max' => 'required',
                    'injection_pressure_max' => 'required',
                    'hold_pressure' => 'required',
                    'clamp_force' => 'required',
                    'clamp_stroke' => 'required',
                    'installed_heating_capacity' => 'required',
                    'dry_cycle_time' => 'required',
                    'hydraulic_system_pressure' => 'required',
                    'oil_capacity' => 'required',
                    'net_weight' => 'required',
                    'manufacturer_id' => 'required|integer|exists:accounts,id',
                    'actuation_id' => 'required|integer|exists:code_values,id',
                    'connected_actuators_1' => 'required|integer|exists:code_values,id',
                    'connected_actuators_2' => 'integer|exists:code_values,id',
                    'status' => 'required|in:A,I',
                ];
            }
            default:break;
        }
    }
}
