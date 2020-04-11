<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'teaCategory' => ['required'],
          'teaName' => ['required', 'string'],
          'teaKind' => ['required'],
          'teaTaste' => ['required'],
          'cardDescription' => ['required', 'string'],
          'fullDescription' => ['required', 'string'],
          'teaPrice' => ['required', 'numeric'],
          'teaImg' => ['required', 'file' ,'mimes:jpeg,jpg,png'],
        ];
    }
}
