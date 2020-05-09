<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrder extends FormRequest
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
            'name' => 'required|max:25|alpha',
            'phone' => 'required|max:12',
            'email'=>'required|email',
        ];
        if ($this->route()->named('admin.order.update')) {
            if ($this->has('product_id', 'increment')) {
                return [];
            }
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'required' => __('validation.required'),
            'alpha' => __('validation.alpha'),
            'max' => __('validation.max.numeric'),
            'email'=> __('validation.email'),
        ];
    }
}
