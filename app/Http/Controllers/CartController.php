<?php

namespace App\Http\Controllers;

use App\Common\Constants;
use App\Http\Requests\AddProductToCartRequest;
use App\Http\Requests\UpdateCartItemQuantityRequest;
use App\ModelConstants\PaymentMethodConstants;
use App\Services\CartService;
use App\Services\CommonService;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    private $commonService;
    private $cartService;
    private $customerService;

    public function __construct()
    {
        $this->commonService = new CommonService();
        $this->cartService = new CartService();
        $this->customerService = new CustomerService();
    }

    public function index()
    {
        $categoryTrees = $this->commonService->getCategoryTrees();
        $customer = Auth::guard('customer')->user();
        $customCartItems = $this->cartService->getCustomCartItemsByCustomerId($customer->id);
        $customerAddresses = $this->customerService->getCustomerAddresses($customer->id);

        $data = [
            'pageTitle' => 'Cart',
            'categoryTrees' => $categoryTrees,
            'customCartItems' => $customCartItems,
            'customerAddresses' => $customerAddresses,
            'paymentMethods' => PaymentMethodConstants::toArray(),
        ];

        return view('pages.cart.cart-page', ['data' => $data]);
    }

    public function updateCartItemQuantity(
        UpdateCartItemQuantityRequest $updateCartItemQuantityRequest,
        $cartItemId
    ) {
        $updateCartItemQuantityProperties = $updateCartItemQuantityRequest->validated();
        $this->cartService->updateCartItemQuantity(
            $updateCartItemQuantityProperties['quantity'],
            $cartItemId
        );

        Session::flash(Constants::ACTION_SUCCESS, Constants::UPDATE_SUCCESS);
        return redirect()->action([CartController::class, 'index']);
    }

    public function checkout()
    {
        $categoryTrees = $this->commonService->getCategoryTrees();
        $customer = Auth::guard('customer')->user();
        $customCartItems = $this->cartService->getCustomCartItemsByCustomerId($customer->id);
        $customerAddresses = $this->customerService->getCustomerAddresses($customer->id);

        $data = [
            'pageTitle' => 'Cart',
            'categoryTrees' => $categoryTrees,
            'customCartItems' => $customCartItems,
            'customerAddresses' => $customerAddresses,
            'paymentMethods' => PaymentMethodConstants::toArray(),
        ];

        return view('pages.cart.checkout-page', ['data' => $data]);
    }

    public function deleteCartItem($cartItemId)
    {
        $this->cartService->deleteCartItem($cartItemId);

        Session::flash(Constants::ACTION_SUCCESS, Constants::DELETE_SUCCESS);
        return redirect()->action([CartController::class, 'index']);
    }

    public function addProductToCart(AddProductToCartRequest $addProductToCartRequest)
    {
        $addProductToCartProperties = $addProductToCartRequest->validated();
        $customer = Auth::guard('customer')->user();
        $this->cartService->addProductToCart($addProductToCartProperties, $customer->id);
        Session::flash(Constants::ACTION_SUCCESS, Constants::ADD_TO_CART_SUCCESS);
        return back();
    }
}
