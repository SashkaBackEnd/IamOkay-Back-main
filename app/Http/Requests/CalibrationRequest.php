<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalibrationRequest extends FormRequest
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
            'patient_id' => 'integer|required', 
            'systolic_1' => 'integer|required', 
            'systolic_2' => 'integer|required', 
            'systolic_3' => 'integer|required',
            'diastolic_1' => 'integer|required', 
            'diastolic_2' => 'integer|required', 
            'diastolic_3' => 'integer|required'
        ];
    }
}
