<?php

namespace ksec\Http\Requests;

use ksec\Http\Requests\Request;

class PlanningRequest extends Request
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
                //$this->input('cycle_time_standard');
                $rules =  [
                    'machine_id' => 'required|exists:machines,id',
                    'mold_id' => 'required|exists:molds,id',
                    'product_id' => 'required|exists:products,id',
                    'start_date_time' => 'required|date_format:d-m-Y H:i',
                    'end_date_time' => 'required|date_format:d-m-Y H:i',
                    'planning_quantity' => 'required|integer',
                    'status' => 'required|in:P,C,SC,CN,R',
                    'cycle_time_standard' => 'required',
                    'cycle_time' => 'required',
                    'cavity_block_standard' => 'required',
                    'cavity_blocks' => 'required',
                    'not_available_standard' => 'required',
                    'change_over_time_id' => 'exists:downtime_subreasons,id',
                    'time_required' => 'required',
                    'time_required_days' => 'required',
                    'time_required_hrs' => 'required',
                    'time_required_mins' => 'required',
                ];

                if($this->input('cycle_time_standard') != $this->input('cycle_time')){
                    $rules['cycle_time_reason'] = 'required';
                }
                if($this->input('cavity_block_standard') != $this->input('cavity_blocks')){
                    $rules['cavity_block_reason'] = 'required';
                }

                if($this->input('cycle_time_standard') != $this->input('cycle_time')){
                    $rules['cycle_time_reason'] = 'required';
                }
                if($this->input('not_available_time_hrs') !== null && !empty($this->input('not_available_time_hrs')) || $this->input('not_available_time_min') !== null && !empty($this->input('not_available_time_min')) ){
                    $rules['not_available_time_reason'] = 'required';
                }

                if(!empty($this->input('change_over_time_hrs')) || !empty($this->input('change_over_time_min'))){
                    $rules['change_over_time_reason'] = 'required';
                }
                if($this->input('status') == 'C' || $this->input('status') == 'SC'){
                    $rules['close_date_time'] = 'required';
                }
                return $rules;
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                   // 'mold_name' => 'required|unique:molds,mold_name,'.$this->route()->getParameter('mold').',id,deleted_at,NULL',
                ];
            }
            default:break;
        }
    }
}
