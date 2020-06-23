<?php

namespace App\Http\Requests\Admin;

use App\Models\AdminUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminUserUpdate extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(AdminUser::class)->ignore($this->admin_user)
            ],
            'password' => 'nullable|alpha_dash|min:4|confirmed',
            'is_owner' => 'nullable|boolean',
        ];
    }
}
