<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAllAnswerRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {

        //TODO

        return [
            'answers' => 'required',
            'answers.*.questionId' => 'required|integer|distinct|exists:questions,id',
            'answers.*.answer' => 'required|string',
        ];
    }
}
