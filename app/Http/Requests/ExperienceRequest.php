<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExperienceRequest extends FormRequest
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
            'data'=>"required|max:255",
            'task_name'=>"required|max:255",
            'company_name'=>"required|max:255"
        ];
    }
    public function messages()
    {
        return [
            'data.required'=>"Çalışma Tarihi girilmesi zorunludur",
            'data.max'=>"en fazla 255 girilmesi zorunludur",
            'task_name.required'=>"Pozisyon girilmesi zorunludur",
            'task_name.max'=>" en fazla 255 girilmesi zorunludur",
            'company_name.required'=>"Firma adı girilmesi zorunludur",
            'company_name.max'=>"en fazla 255 girilmesi zorunludur"

        ];
    }
}
