<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProduct extends FormRequest
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
            'name' => 'required|max:40',
            'code' => 'required|max:20',
            'description' => 'required|max:80',
            'category_id' => 'required',
            'price' => 'required|integer|min:0',
            'image' => 'nullable|file|mimes:jpeg,png,jpg|max:2000',
            'product_count'=>'required|integer|min:0'
        ];
    }

    public function messages()
    {
        return [
            'required' => __('validation.required'),
            'alpha' => __('validation.alpha'),
            'max' => __('validation.max.numeric'),
            'integer' => __('validation.integer'),
            'min' => __('validation.min.numeric'),
            'file'=>__('validation.file'),
            'mimes'=>__('validation.mimes'),
            'image.max'=>__('validation.max.file'),
        ];
    }
}
