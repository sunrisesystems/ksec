<?php

namespace cvmapp\Http\Requests;

use cvmapp\Http\Requests\Request;

class ResetPasswordRequest extends Request
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
            'userId' => 'required|exists:users,id',
            'password' => 'required|between:6,15',
            'confirmPassword' => 'required|same:password|between:6,15',
        ];
    }
}
