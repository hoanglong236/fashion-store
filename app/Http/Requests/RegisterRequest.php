<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'phone' => 'required',
            'gender' => 'required|boolean',
            'email' => [
                'required', 'email', 'max:64',
                Rule::unique('customers', 'email')->where('delete_flag', false)
            ],
            'password' => ['required', Password::min(8)],
            'confirmPassword' => 'required|same:password',
        ];
    }

    /**
     * Override the default
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'gender' => $this->gender === "true" ? true : false,
        ]);
    }
}
