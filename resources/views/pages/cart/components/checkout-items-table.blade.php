<table class="table order-items-table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Product</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total price</th>
        </tr>
    </thead>
    <tbody>
        @php
            $total = 0;
        @endphp
        @foreach ($customCartItems as $index => $customCartItem)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    <img height="40" src="{{ FirebaseStorageService::getImageUrl($customCartItem->product_main_image_path) }}"
                        alt="">
                </td>
                <td>
                    <a href="{{ route('product.details', $customCartItem->product_slug) }}" class="cart-item-name">
                        {{ $customCartItem->product_name }}
                    </a>
                </td>
                <td>{{ $customCartItem->quantity }}</td>

                @php
                    $total_price = $customCartItem->product_price * (1 - $customCartItem->product_discount_percent / 100) * $customCartItem->quantity;
                    $total += $total_price;
                @endphp
                <td>{{ '$' . number_format($total_price) }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="2"></td>
            <td colspan="2">TOTAL</td>
            <td>{{ '$' . number_format($total) }}</td>
        </tr>
    </tbody>
</table>
