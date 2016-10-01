<?php

namespace ksec\Http\Requests;

use ksec\Http\Requests\Request;

class DrawingRequest extends Request
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
                    'drawing_no' => 'required|unique:drawings,drawing_no,NULL,id,deleted_at,NULL',
                    'preform_condition_id'  => 'required|integer',
                    'blow_condition_id'  => 'required|integer',
                    'sct_l' => 'required',
                    'sct_c' => 'required',
                    'sct_h' => 'required',
                    'std_cavities' => 'required',
                    'std_cavitiy_blocks' => 'required',
                    'std_wt_l' => 'required',
                    'std_wt_c' => 'required',
                    'std_wt_h' => 'required',
                    'drawing_wt_l' => 'required',
                    'drawing_wt_c' => 'required',
                    'drawing_wt_h' => 'required',
                    'min_wall_thickness' => 'required',
                    'avg_wall_thickness' => 'required',
                    'body_diameter_l' => 'required',
                    'body_diameter_c' => 'required',
                    'body_diameter_h' => 'required',
                    'height_l' => 'required',
                    'height_c' => 'required',
                    'height_h' => 'required',
                    'ofc_l' => 'required',
                    'ofc_c' => 'required',
                    'ofc_h' => 'required',
                    'fpc_l' => 'required',
                    'fpc_c' => 'required',
                    'fpc_h' => 'required',
                    'neck_height_l' => 'required',
                    'neck_height_c' => 'required',
                    'neck_height_h' => 'required',
                    'bottle_shape_id' => 'required|integer',
                    'neck_size_id' => 'required|integer',
                    'neck_type_id' => 'required|integer',
                    'num_of_thread_turns' => 'required',
                    'drawing_file' => 'required|mimes:pdf',
                    'manufacturer_id' => 'required|exists:accounts,id',
                    'std_rejection' => 'required',
                    'std_purging' => 'required',
                    'status' => 'required|in:A,I',
                    'complete_mold_changeover' => 'required',
                    'partial_mold_changeover' => 'required',
                    'blow_mold_changeover' => 'required',
                    'injection_mold_changeover' => 'required',
                    'base_mold_changeover' => 'required',
                    'partial_mold_changeover_a' => 'required',
                    'partial_mold_changeover_b' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'drawing_no' => 'required|unique:drawings,drawing_no,'.$this->route()->getParameter('drawings').',id,deleted_at,NULL',
                    'preform_condition_id'  => 'required|integer',
                    'blow_condition_id'  => 'required|integer',
                    'sct_l' => 'required',
                    'sct_c' => 'required',
                    'sct_h' => 'required',
                    'std_cavities' => 'required',
                    'std_cavitiy_blocks' => 'required',
                    'std_wt_l' => 'required',
                    'std_wt_c' => 'required',
                    'std_wt_h' => 'required',
                    'drawing_wt_l' => 'required',
                    'drawing_wt_c' => 'required',
                    'drawing_wt_h' => 'required',
                    'min_wall_thickness' => 'required',
                    'avg_wall_thickness' => 'required',
                    'body_diameter_l' => 'required',
                    'body_diameter_c' => 'required',
                    'body_diameter_h' => 'required',
                    'height_l' => 'required',
                    'height_c' => 'required',
                    'height_h' => 'required',
                    'ofc_l' => 'required',
                    'ofc_c' => 'required',
                    'ofc_h' => 'required',
                    'fpc_l' => 'required',
                    'fpc_c' => 'required',
                    'fpc_h' => 'required',
                    'neck_height_l' => 'required',
                    'neck_height_c' => 'required',
                    'neck_height_h' => 'required',
                    'bottle_shape_id' => 'required|integer',
                    'neck_size_id' => 'required|integer',
                    'neck_type_id' => 'required|integer',
                    'num_of_thread_turns' => 'required',
                    'drawing_file' => 'mimes:pdf',
                     'manufacturer_id' => 'required|exists:accounts,id',
                    'std_rejection' => 'required',
                    'std_purging' => 'required',
                    'status' => 'required|in:A,I',
                    'complete_mold_changeover' => 'required',
                    'partial_mold_changeover' => 'required',
                    'blow_mold_changeover' => 'required',
                    'injection_mold_changeover' => 'required',
                    'base_mold_changeover' => 'required',
                    'partial_mold_changeover_a' => 'required',
                    'partial_mold_changeover_b' => 'required',

                ];
            }
            default:break;
        }
    }
}
