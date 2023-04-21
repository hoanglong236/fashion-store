<?php

namespace App\Http\Requests;

use App\ModelConstants\PaymentMethodConstants;
use App\Models\Cart;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PlaceOrderRequest extends FormRequest
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
        $customer = Auth::guard('customer')->user();
        $cart = Cart::where('customer_id', $customer->id)->first();

        return [
            'cartItemIds.*' => [
                'required',
                Rule::exists('cart_items', 'id')->where('cart_id', $cart->id),
            ],
            'deliveryAddress' => 'required',
            'paymentMethod' => [
                'required',
                Rule::in(PaymentMethodConstants::toArray()),
            ],
        ];
    }

    /**
     * Override the default
     */
    public function messages()
    {
        return [
            'cartItemIds.*.exists' => 'ID of cart item #:position invalid.',
        ];
    }
}
