<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiRequest;

class TodoRequest extends ApiRequest
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
            'task' => 'required_without_all|max:150',
            'completed' => 'nullable|boolean'
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
            'task.required_without_all' => 'A task is required'
        ];
    }
}
