<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderAddRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:sliders|max:255|min:5',
            'description' => 'required',
            'image_path' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được bỏ trống',
            'name.unique' => 'Tên không được trùng',
            'name.max' => 'Tên không được nhiều hơn 255 kí tự',
            'name.max' => 'Tên không được ít hơn 5 kí tự',
            'description.required' => 'Mô tả không được bỏ trống',
            'image_path.required' => 'Ảnh không được bỏ trống',
        ];
    }
}
