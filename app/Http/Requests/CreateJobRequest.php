<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateJobRequest extends FormRequest
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
            'title' => 'required',
            'category' => 'required',
            'sub_category' => 'required',
            'city' => 'required',
            'need_people' => 'required',
            'date_start' => 'required',
            'time_start' => 'required',
            'date_finish' => 'required',
            'time_finish' => 'required',
            'price' => 'required',
            'description' => 'required',

        ];
    }
}
