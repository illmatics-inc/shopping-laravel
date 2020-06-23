<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductIndex extends FormRequest
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
            'product_category_id' => 'nullable|integer',
            'keyword' => 'nullable|string',
            'sort' => [
                'filled',
                Rule::in([
                    'review_rank-desc',
                    'price-asc',
                    'price-desc',
                    'updated_at-desc',
                ]),
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function productCategoryId()
    {
        return $this->input('product_category_id');
    }

    /**
     * @return mixed
     */
    public function keyword()
    {
        return $this->input('keyword');
    }

    /**
     * @return mixed
     */
    public function sort()
    {
        return $this->input('sort', 'review_rank-desc');
    }
}
