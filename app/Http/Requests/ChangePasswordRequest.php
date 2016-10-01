<?php

namespace ksec\Http\Requests;

use ksec\Http\Requests\Request;

class ChangePasswordRequest extends Request
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
            'oldPassword' => 'required|between:6,15',
            'newPassword' => 'required|between:6,15',
            'confirmPassword' => 'required|same:newPassword|between:6,15',
        ];
    }
}
