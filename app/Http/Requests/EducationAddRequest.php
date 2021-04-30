<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationAddRequest extends FormRequest
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
            "university_date"=>"required|max:255",
            "university_name"=>"required|max:255",
            "university_branch"=>"required|max:255",
        ];
    }
    public function messages()
    {
        return
        [
        'university_date.required'=>"Eğitim tarihi girilmesi zorunludur",
        'university_date.max'=>"En fazla 255 karekter giriniz",
        'university_name.required'=>"Üniversite adı girilmesi zorunludur",
        'university_name.max'=>"En fazla 255 karekter giriniz",
        'university_branch.required'=>"Üniversite bölüm girilmesi zorunludur",
        'university_branch.max'=>"En fazla 255 karekter giriniz",
      ];
    }
}
