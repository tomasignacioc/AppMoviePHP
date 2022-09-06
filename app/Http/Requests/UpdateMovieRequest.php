<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateMovieRequest extends FormRequest
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
            'title' => [
                Rule::unique('movies')->ignore($this->route('movie')),
                'string', 'max:100'
            ],
            'image_url' => ['string'],
            'genres' => ['array'],
            'premiered_at' => ['date'],
            'score' => ['integer', 'between:1,10']
        ];
    }
}
