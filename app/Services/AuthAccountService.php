<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AuthAccountService
{
    private $cartService;

    public function __construct()
    {
        $this->cartService = new CartService();
    }

    public function register($registerProperties)
    {
        $customer = Customer::create([
            'name' => $registerProperties['name'],
            'phone' => $registerProperties['phone'],
            'gender' => $registerProperties['gender'],
            'email' => $registerProperties['email'],
            'password' => Hash::make($registerProperties['password']),
        ]);
        $this->cartService->createCustomerCart($customer->id);
    }

    public function login($loginProperties)
    {
        return Auth::guard('customer')->attempt([
            'email' => $loginProperties['email'],
            'password' => $loginProperties['password'],
            'disable_flag' => false,
            'delete_flag' => false,
        ]);
    }

    public function logout()
    {
        Auth::logout();
        Session::invalidate();
        Session::regenerateToken();
    }
}
