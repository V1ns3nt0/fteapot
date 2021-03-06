<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPassRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'oldPass'=> ['required', 'password'],
            'password'=>['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
