<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'first_name' => ['string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'username' => [
                'string',
                'max:255',
                Rule::unique('users')->ignore($id),
            ],
            'email' => [
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($id),
            ],
            'password' => [Password::defaults()],
            'is_admin' => ['boolean'],
            'is_active' => ['boolean'],
        ];
    }
}
