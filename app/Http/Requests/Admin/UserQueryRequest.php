<?php

namespace App\Http\Requests\Admin;

use App\Enums\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UserQueryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'search' => ['nullable', 'max:255', 'min:1'],
            'role' => ['nullable', new enum(Role::class)],
            'field' => ['required_with:direction', 'in:name,email,role,created_at,updated_at'],
            'direction' => ['required_with:field', 'in:asc,desc'],
        ];
    }
}
