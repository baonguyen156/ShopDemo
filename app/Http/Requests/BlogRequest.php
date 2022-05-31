<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'title' => 'required',
            'file' => 'image|mimes:jpeg,png,gif|max: 2048',
            'description' => 'required',
            'content' => 'required',
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
            'title' => 'Tiêu đề',
            'file' => 'Hình ảnh',
            'description' => 'Mô tả',
            'content' => 'Nội dung'
        ];
    }
}
