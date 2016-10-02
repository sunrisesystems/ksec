<?php

namespace cvmapp\Http\Requests;

use cvmapp\Http\Requests\Request;
use Sentinel;

class UpdateProfileRequest extends Request
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
        $id = Sentinel::getUser()->id;
        return [
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'email' => 'email|unique:users,email,'.$id.',id,deleted_at,NULL',
            'username' => 'required|between:5,15|unique:users,username,'.$id.',id,deleted_at,NULL',
        ];
    }
}
