<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessagesCreate extends FormRequest
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
            'message' => 'required|min:10',
            'visits' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'message.required' => 'The Message field is required.',

            'visits.required' => 'The option "link visits" is required.',
            'visits.integer' => 'The option "link visits" must be an integer.',
        ];
    }
}
