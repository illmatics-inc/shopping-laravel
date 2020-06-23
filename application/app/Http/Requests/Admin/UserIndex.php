<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserIndex extends FormRequest
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
            'name' => 'nullable|string',
            'email' => 'nullable|string',
            'sort_column' => [
                'filled',
                Rule::in([
                    'id',
                    'name',
                    'email',
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
    public function name()
    {
        return $this->input('name');
    }

    /**
     * @return mixed
     */
    public function email()
    {
        return $this->input('email');
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
