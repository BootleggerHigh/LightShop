<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategory extends FormRequest
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
        $rules = [
            'name' => 'required|max:20',
            'code' => 'required|alpha|max:20|unique:categories,code',
            'description' => 'required|max:100',
            'image' => 'nullable|file|mimes:jpeg,png,jpg|max:2000',
        ];
        if ($this->route()->named('admin.category.update')) {
            $rules['code'] .= ',' . $this->route()->parameter('category');
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'required' => __('validation.required'),
            'alpha' => __('validation.alpha'),
            'max' => __('validation.max.numeric'),
            'unique' => __('validation.max.unique'),
            'file'=>__('validation.file'),
            'mimes'=>__('validation.mimes'),
            'image.max'=>__('validation.max.file'),
        ];
    }
}
