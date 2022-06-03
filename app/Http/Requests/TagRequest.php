<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
        $id = $this->route('id');
        // علشان استقبل ال اى دى من الروات
        return [
            'name' => ['required', 'between:3,255', 'string', "unique:tags,name,$id"]
            // هنا بعمل الفالديت برضو
        ];
    }
    // public function messages()
    // // دى فانكشن علشان اقدر ابعت رسايل الخطا اللى انا عايزها فى الريكويست دا
    // {
    //     return[
    //         'required'=>'هذا الحقل مطلوب ',
    //         'unique'=>' :attribute هذا الحقل موجودة مسبقا',
    //         // :attribute
    //         // دا بيظهرلى اسم الحقل اللى فيه الخطا
    //         'name.required' => 'هذا الحقل مطلوب ',
    //         // النيم هنا علشان اخصص الحقل اللى عايز اعمله الرسالة

    //     ];
    // }
}
