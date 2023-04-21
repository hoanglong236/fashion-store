<?php

namespace App\Http\Controllers;

use App\Common\Constants;
use App\Http\Requests\PlaceOrderRequest;
use App\Services\CartService;
use App\Services\CommonService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    private $commonService;
    private $orderService;
    private $cartService;

    public function __construct()
    {
        $this->commonService = new CommonService();
        $this->orderService = new OrderService();
        $this->cartService = new CartService();
    }

    public function index()
    {
        $customer = Auth::guard('customer')->user();
        $customOrders = $this->orderService->getCustomOrdersByCustomerId($customer->id);

        $data = [
            'pageTitle' => 'Customer Account Information',
            'categoryTrees' => $this->commonService->getCategoryTrees(),
            'customOrders' => $customOrders,
        ];
        return view('pages.order.orders-page', ['data' => $data]);
    }

    public function showDetails($orderId)
    {
        $customOrder = $this->orderService->getCustomOrderByOrderId($orderId);
        $customOrderItems = $this->orderService->getCustomOrderItemsByOrderId($orderId);
        $data = [
            'pageTitle' => 'Order details',
            'categoryTrees' => $this->commonService->getCategoryTrees(),
            'customOrder' => $customOrder,
            'customOrderItems' => $customOrderItems,
        ];
        return view('pages.order.order-details-page', ['data' => $data]);
    }

    public function placeOrder(PlaceOrderRequest $placeOrderRequest)
    {
        $placeOrderProperties = $placeOrderRequest->validated();
        $customer = Auth::guard('customer')->user();
        $placeOrderSuccess = $this->orderService->placeOrder($placeOrderProperties, $customer->id);

        if (!$placeOrderSuccess) {
            Session::flash(Constants::ACTION_ERROR, Constants::PLACE_ORDER_FAILED);
            return redirect()->action([CartController::class, 'index']);
        }

        $this->cartService->clearCustomerCart($customer->id);
        Session::flash(Constants::ACTION_SUCCESS, Constants::CREATE_SUCCESS);
        return redirect()->action([OrderController::class, 'index']);
    }

    public function cancelOrder($orderId) {
        $customer = Auth::guard('customer')->user();
        $isSuccess = $this->orderService->cancelOrder($orderId, $customer->id);

        if ($isSuccess) {
            Session::flash(Constants::ACTION_SUCCESS, Constants::ORDER_CANCEL_SUCCESS);
        } else {
            Session::flash(Constants::ACTION_ERROR, Constants::ORDER_CANCEL_FAILURE);
        }
        return redirect()->action([OrderController::class, 'index']);
    }
}
