<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'price' => 'required',
            'idcategory' => 'required',
            'idbrand' => 'required',
            'status' => 'required',
            'company' => 'required',
            'image.*' => 'required|image|mimes:jpeg,png,jpg|max:1024',
            'detail' => 'required'
        ];
    }
    public function message()
    {
        return [
            'required'=>'attribute bắt buộc nhập',
            'max'=>'attribute không được quá :max KB',
            'image' =>'attribute là file hình ảnh'
        ];
    }
    public function attribute()
    {
        return [
            'name' => 'Tên sản phẩm',
            'price' => 'Giá sản phẩm',
            'idcategory' => 'Danh mục',
            'idbrand' => 'Nhãn hiệu',
            'status' => 'Trạng thái',
            'company' => 'Công ty',
            'image' => 'Hình ảnh',
            'detail' => 'Chi tiết sản phẩm'
        ];
    }
}
