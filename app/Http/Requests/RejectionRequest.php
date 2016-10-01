<?php

namespace ksec\Http\Requests;

use ksec\Http\Requests\Request;

class RejectionRequest extends Request
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
                    'defect_nature_id' => 'required|exists:defect_nature,id',
                    'defect_reason_id' => 'required|exists:defect_reasons,id',
                    'defect' => 'required',
                    'status' => 'required|in:A,I',
                    'ccb' => 'required|in:Y,N',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'defect_nature_id' => 'required|exists:defect_nature,id',
                    'defect_reason_id' => 'required|exists:defect_reasons,id',
                    'defect' => 'required',
                    'status' => 'required|in:A,I',
                    'ccb' => 'required|in:Y,N',
                ];
            }
            default:break;
        }
    }
}
