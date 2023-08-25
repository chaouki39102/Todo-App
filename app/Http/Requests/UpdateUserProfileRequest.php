<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateUserProfileRequest extends FormRequest
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
        return [
            'name' => 'required|string|min:2|max:100',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore(userId())],
            'gender' => 'required|in:male,female',
            'job_title' => 'nullable|string|min:2|max:100',
            'bio' => 'nullable|string',
            'password' => [
                'nullable',
                'confirmed',
                Password::min(3),//->mixedCase()->letters()->numbers()->symbols(),
            ],
            'old_password' => [
                'nullable',
                'required_with: password',
                Password::min(3),
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, authUser()->password)) {
                        $fail('Wrong old password !');
                    }
                }
            ],
            'avatar' => 'nullable|file|max:2000|mimes:png,jpg,jpeg'
        ];
    }
}
