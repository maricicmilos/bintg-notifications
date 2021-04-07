<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHospitalRequest extends FormRequest
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
            'name' => 'required',
            'serial_number' => 'required|max:8',
            'image' => 'mimes:jpeg,png,gif'
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
            'name.required' => 'Name field is required',
            'serial_number.required' => 'Serial number is required',
            'serial_number.max' => 'Must contain less then 8 characters',
            'image.mimes' => 'Not supported image type'
        ];
    }
}
