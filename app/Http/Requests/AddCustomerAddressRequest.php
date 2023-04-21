<?php

namespace App\Http\Requests;

use App\ModelConstants\AddressType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddCustomerAddressRequest extends FormRequest
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
            'city' => 'required|max:64',
            'district' => 'required|max:64',
            'ward' => 'required|max:64',
            'specificAddress' => 'required|max:64',
            'addressType' => [
                'required',
                Rule::in(AddressType::toArray()),
            ],
            'defaultFlag' => 'required|boolean',
        ];
    }

    /**
     * Override the default
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'defaultFlag' => $this->defaultFlag === "true" ? true : false,
        ]);
    }
}
