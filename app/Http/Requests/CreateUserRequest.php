<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'firstname' => ':required',
            'lastname' => ':required',
            'email' => ':required',
            'specialty_id' => ':required',
            'hospital_id' => ':required'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'firstname.required' => 'First Name is required',
            'lastname.required' => 'Last Name is required',
            'email.required' => 'Email is required',
            'specialty_id.required' => 'Please define User Specialty',
            'hospital_id.required' => 'Please dedicate Hospital to User'
        ];
    }
}
