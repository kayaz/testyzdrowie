<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamFormRequest extends FormRequest
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
            'active' => 'boolean',
            'name' => 'required|string|min:5|max:190',
            'text' => '',
            'video' => '',
            'statute' => '',
            'time_limit' => 'required|integer',
            'attempts' => 'required|integer',
            'question' => 'required|integer',
            'pass' => 'required|integer',
            //'date_start' => 'required|date_format:Y-m-d|before_or_equal:date_end',
            //'date_end' => 'required|date_format:Y-m-d|after_or_equal:date_start',
            //'exam_dates' => 'required|string'
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
            'name.required' => 'To pole jest wymagane',
            'name.max.string' => 'Maksymalna ilość znaków: 190',
            'name.min.string' => 'Minimalna ilość znaków: 5',
            'time_limit.required' => 'To pole jest wymagane',
            'time_limit.integer' => 'Tylko liczby',
            'attempts.required' => 'To pole jest wymagane',
            'attempts.integer' => 'Tylko liczby',
            'questions.required' => 'To pole jest wymagane',
            'questions.integer' => 'Tylko liczby',
            'pass.required' => 'To pole jest wymagane',
            'pass.integer' => 'Tylko liczby',
            //'date_start.required' => 'To pole jest wymagane',
            //'date_start.before_or_equal' => 'Pole musi być datą nie późniejszą niż zakończenie.',
            //'date_end.required' => 'To pole jest wymagane',
            //'date_end.after_or_equal' => 'Pole musi być datą nie wcześniejszą niż rozpoczęcie.',
            //'exam_dates.required' => 'To pole jest wymagane',
        ];
    }
}
