<?php

namespace cvmapp\Http\Requests;

use cvmapp\Http\Requests\Request;

class LoginRequest extends Request
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
        return [
            'systemId' => 'required|exists:employees,system_id',
            'password' => 'required'
        ];
    }
}
