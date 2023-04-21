<?php

namespace App\Services;

use App\ModelConstants\OrderStatusConstants;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService
{
    private $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }

    public function getCustomOrdersByCustomerId($customerId)
    {
        return DB::table('orders')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->select(
                'orders.id',
                'orders.customer_id',
                'orders.delivery_address',
                'orders.status',
                'orders.payment_method',
                'orders.created_at',
                'orders.updated_at',
                'customers.name as customer_name',
                'customers.phone as customer_phone',
                'customers.email as customer_email',
                DB::raw('sum(order_items.total_price) as total'),
            )
            ->where('orders.customer_id', $customerId)
            ->groupBy('orders.id')
            ->orderByDesc('orders.created_at')
            ->get();
    }

    public function getCustomOrderByOrderId($orderId)
    {
        return DB::table('orders')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->select(
                'orders.id',
                'orders.customer_id',
                'orders.delivery_address',
                'orders.status',
                'orders.payment_method',
                'orders.created_at',
                'orders.updated_at',
                'customers.name as customer_name',
                'customers.phone as customer_phone',
                'customers.email as customer_email',
                DB::raw('sum(order_items.total_price) as total'),
            )
            ->where('orders.id', $orderId)
            ->groupBy('orders.id')
            ->orderByDesc('orders.created_at')
            ->first();
    }

    public function getCustomOrderItemsByOrderId($orderId)
    {
        return DB::table('order_items')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->select(
                'products.name as product_name',
                'products.main_image_path as image_path',
                'order_items.product_id',
                'order_items.quantity',
                'order_items.total_price',
            )
            ->where(['order_items.order_id' => $orderId])
            ->get();
    }

    public function placeOrder($placeOrderProperties, $customerId)
    {
        $cartItems = CartItem::whereIn('id', $placeOrderProperties['cartItemIds'])->get();
        foreach ($cartItems as $cartItem) {
            if (!$this->checkProductQuantity($cartItem->product_id, $cartItem->quantity)) {
                return false;
            }
        }

        $order = Order::create([
            'customer_id' => $customerId,
            'delivery_address' => $placeOrderProperties['deliveryAddress'],
            'payment_method' => $placeOrderProperties['paymentMethod'],
        ]);
        foreach ($cartItems as $cartItem) {
            $product = $this->productService->getProductById($cartItem->product_id);
            $product->quantity -= $cartItem->quantity;
            $product->save();

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'total_price' => $product->price * (1 - $product->discount_percent / 100) * $cartItem->quantity,
            ]);
        }
        return true;
    }

    private function checkProductQuantity($productId, $quantity)
    {
        $product = $this->productService->getProductById($productId);
        return $quantity <= $product->quantity;
    }

    public function cancelOrder($orderId, $customerId)
    {
        $order = Order::where('id', $orderId)->first();
        if ($order->customer_id !== $customerId) {
            return false;
        }
        switch ($order->status) {
            case OrderStatusConstants::RECEIVED:
            case OrderStatusConstants::PROCESSING:
                $order->status = OrderStatusConstants::CANCELLED;
                $order->save();
                return true;
            default:
                return false;
        }
    }
}
