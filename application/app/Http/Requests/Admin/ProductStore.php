<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductStore extends FormRequest
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
            'price' => 'required|numeric|min:0',
            'product_category_id' => 'required|numeric',
            'description' => 'nullable',
            'image_path' => 'nullable|file|image|mimes:jpg,jpeg,png,gif',
        ];
    }
}
