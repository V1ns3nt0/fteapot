<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'state' => ['required', 'string', 'max:250'],
          'city' => ['required', 'string','max:120'],
          'street' => ['required', 'string', 'max:250'],
          'house' => ['required'],
          'postal_code' => ['required', 'regex:/\b\d{6}\b/'],
          'last_name' => ['required', 'string'],
          'first_name' => ['required', 'string'],
          'email' => ['required' ,'email'],
        ];
    }
}
