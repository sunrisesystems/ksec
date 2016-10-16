<?php

namespace ksec\Http\Requests;

use ksec\Http\Requests\Request;

class SubTypeCallIdRequest extends Request
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
            'callType' => 'required|exists:call_types,id',
        ];
    }
}
