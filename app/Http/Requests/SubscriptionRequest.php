<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
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
            'email' => 'required|email',
            'product_id' => 'required|exists:App\Models\Product,id',
        ];
    }

    public function messages()
    {
        return [
            'product_id.exists' => __('validation.exists'),
            'required' => __('validation.required'),
            'email' => __('validation.email'),
        ];
    }
}
