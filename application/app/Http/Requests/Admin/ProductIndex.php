<?php

namespace App\Http\Requests\Admin;

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
            'product_category' => 'nullable|integer',
            'name' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'price_compare' => [
                'filled',
                Rule::in([
                    'gteq',
                    'lteq',
                ]),
            ],
            'sort_column' => [
                'filled',
                Rule::in([
                    'id',
                    'product_category',
                    'name',
                    'price',
                ]),
            ],
            'sort_direction' => [
                'filled',
                Rule::in([
                    'asc',
                    'desc',
                ]),
            ],
            'page_unit' => 'filled|integer',
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
    public function name()
    {
        return $this->input('name');
    }

    /**
     * @return mixed
     */
    public function price()
    {
        return $this->input('price');
    }

    /**
     * @return mixed
     */
    public function priceCompare()
    {
        return $this->input('price_compare');
    }

    /**
     * @return mixed
     */
    public function sortColumn()
    {
        return $this->input('sort_column', 'id');
    }

    /**
     * @return mixed
     */
    public function sortDirection()
    {
        return $this->input('sort_direction', 'asc');
    }

    /**
     * @return mixed
     */
    public function pageUnit()
    {
        return $this->input('page_unit', 10);
    }
}
