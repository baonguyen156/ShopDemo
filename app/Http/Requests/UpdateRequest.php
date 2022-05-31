<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name'=>'required',
            'email'=> 'required',
            'avatar'=>'image|mimes:jpeg,png,gif|max: 2048',
        ];
    }
    public function message()
    {
        return [
            'required'=>'attribute bắt buộc nhập',
            'max'=>'attribute không được quá :max KB',
            'image' =>'attribute là file hình ảnh hoặc gif'
            
        ];
    }
    public function attribute()
    {
        return [
            'name'=>'Tên người dùng',
            'email'=>'Email',
            'avatar'=>'Avatar',
        ];
    }
}
