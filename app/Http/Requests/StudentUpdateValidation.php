<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentUpdateValidation extends FormRequest
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
            'name' => 'required|string|min:2|max:35',
            'email' => 'required|email|max:255|unique:students,email,' . $this->student->id,
            'avatar' =>  'image|mimes:jpeg,png,jpg,gif',
            'password'  => 'required|min:6|max:35',
            'password_confirmation' => 'required|min:6|same:password',
        ];
    }
}
