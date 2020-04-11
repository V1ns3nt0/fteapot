<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddStaffRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'lastName' => ['required', 'string'],
          'firstName' => ['required', 'string'],
          'email' => ['required', 'email', 'unique:users'],
          'password'=>['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
