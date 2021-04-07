<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateHospitalRequest extends FormRequest
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
            'image' => 'required|mimes:jpeg,png,gif'
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
            'image.required' => 'Please upload the image',
            'image.mimes' => 'Not supported image type'
        ];
    }
}
