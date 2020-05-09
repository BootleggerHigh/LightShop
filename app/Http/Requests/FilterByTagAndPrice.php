<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterByTagAndPrice extends FormRequest
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
            'price_from'=>'numeric|nullable|min:0',
            'price_to'=>'numeric|nullable|min:0',
        ];
    }
    public function messages()
    {
        return [
            'numeric' => __('validation.numeric'),
            'min' => __('validation.min.numeric'),
        ];
    }
}
