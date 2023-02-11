<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionFormRequest extends FormRequest
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
            'question' => 'required|string|min:2|max:190',
            'answer_a' => 'required|string|min:2|max:190',
            'answer_b' => 'required|string|min:2|max:190',
            'answer_c' => 'required|string|min:2|max:190',
            'answer_d' => 'required|string|min:2|max:190',
            'correct' => 'required|integer'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'question.required' => 'To pole jest wymagane',
            'question.max.string' => 'Maksymalna ilość znaków: 190',
            'question.min.string' => 'Minimalna ilość znaków: 2',

            'answer_a.required' => 'To pole jest wymagane',
            'answer_a.min.string' => 'Minimalna ilość znaków: 2',
            'answer_a.max.string' => 'Maksymalna ilość znaków: 190',

            'answer_b.required' => 'To pole jest wymagane',
            'answer_b.min.string' => 'Minimalna ilość znaków: 2',
            'answer_b.max.string' => 'Maksymalna ilość znaków: 190',

            'answer_c.required' => 'To pole jest wymagane',
            'answer_c.min.string' => 'Minimalna ilość znaków: 2',
            'answer_c.max.string' => 'Maksymalna ilość znaków: 190',

            'answer_d.required' => 'To pole jest wymagane',
            'answer_d.min.string' => 'Minimalna ilość znaków: 2',
            'answer_d.max.string' => 'Maksymalna ilość znaków: 190',

            'correct.integer' => 'Tylko liczby',
        ];
    }
}
