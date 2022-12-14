<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreMovieRequest extends FormRequest
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
            'title' => ['required', 'unique:movies', 'string', 'max:100'],
            'image_url' => ['required', 'string'],
            'genres' => ['required', 'array'],
            'premiered_at' => ['required', 'date'],
            'summary' => ['required'],
            'score' => ['required', 'integer', 'between:1,10']
        ];
    }
}
