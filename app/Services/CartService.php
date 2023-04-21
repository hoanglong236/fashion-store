<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartService
{
    public function getCustomCartItemsByCustomerId($customerId)
    {
        $cart = $this->getCartByCustomerId($customerId);
        return $this->getCustomCartItemsByCartId($cart->id);
    }

    private function getCartByCustomerId($customerId)
    {
        return Cart::where('customer_id', $customerId)->first();
    }

    private function getCustomCartItemsByCartId($cartId)
    {
        return DB::table('cart_items')
            ->join('products', 'products.id', '=', 'cart_items.product_id')
            ->select([
                'products.name as product_name',
                'products.slug as product_slug',
                'products.price as product_price',
                'products.discount_percent as product_discount_percent',
                'products.quantity as product_quantity',
                'products.main_image_path as product_main_image_path',
                'cart_items.quantity',
                'cart_items.id',
            ])
            ->where('cart_id', $cartId)
            ->get();
    }

    public function updateCartItemQuantity($cartItemQuantity, $cartItemId)
    {
        $cartItem = CartItem::where('id', $cartItemId)->first();
        $cartItem->quantity = $cartItemQuantity;

        $cartItem->save();
    }

    public function deleteCartItem($cartItemId)
    {
        $cartItem = CartItem::where('id', $cartItemId)->first();
        $cartItem->delete();
    }

    public function clearCustomerCart($customerId)
    {
        $cart = $this->getCartByCustomerId($customerId);
        CartItem::where('cart_id', $cart->id)->delete();
    }

    public function createCustomerCart($customerId)
    {
        Cart::create([
            'customer_id' => $customerId,
        ]);
    }

    public function addProductToCart($addProductToCartProperties, $customerId)
    {
        $productId = $addProductToCartProperties['productId'];
        $quantity = $addProductToCartProperties['quantity'];
        $cart = $this->getCartByCustomerId($customerId);

        $cartItem = CartItem::where([
            'cart_id' => $cart->id,
            'product_id' => $productId,
        ])->first();

        if (!is_null($cartItem)) {
           $cartItem->quantity += $quantity;
           $cartItem->save();

           return;
        }

        CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $productId,
            'quantity' => $quantity,
        ]);
    }
}
