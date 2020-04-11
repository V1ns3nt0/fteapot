<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'country' => ['required', 'string', 'max:250'],
          'state' => ['required', 'string', 'max:250'],
          'city' => ['required', 'string','max:120'],
          'street' => ['required', 'string', 'max:250'],
          'house' => ['required'],
          'postal_code' => ['required', 'size:6'],
        ];
    }
}
