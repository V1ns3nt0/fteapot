<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditArticleRequest extends FormRequest
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
          'articleImg' => [ 'file' ,'mimes:jpeg,jpg,png'],
        ];
    }
}
