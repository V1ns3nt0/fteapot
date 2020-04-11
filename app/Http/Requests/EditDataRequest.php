<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditDataRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'last_name' => ['string'],
            'first_name' => ['string'],
            'email' => ['email'],
        ];
    }
}
