<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberLoginRequest extends FormRequest
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
            'email'=> 'required',
            'password'=>'required',
        ];
    }
    public function message()
    {
        return [
            'required'=>'attribute bắt buộc nhập',  
        ];
    }
    public function attribute()
    {
        return [
            'password'=>'Mật khẩu',
            'email'=>'Email',
        ];
    }
}
