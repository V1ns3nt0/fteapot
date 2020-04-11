<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddArticleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'title' => ['required', 'string'],
          'description' => ['required', 'string'],
          'content' => ['required', 'string'],
          'articleImg' => ['required', 'file' ,'mimes:jpeg,jpg,png'],
        ];
    }
}
