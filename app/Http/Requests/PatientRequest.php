<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
            "name" => 'required|string',
            "birth" => 'required|string',
            "gender_id" => 'required|integer',
            "user_id" => 'required|integer',
            "growth" => 'required|integer',
            "wieght" => 'required|integer',
            "stride_lenth" => 'required|integer',
            "subscription" => 'string',
        ];
    }
}
