<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'teaName' => ['required', 'string'],
          'cardDescription' => ['required', 'string'],
          'fullDescription' => ['required', 'string'],
          'teaPrice' => ['required', 'numeric'],
          'teaImg' => ['file' ,'mimes:jpeg,jpg,png'],
        ];
    }
}
