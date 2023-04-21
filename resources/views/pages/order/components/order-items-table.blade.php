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
        @foreach ($customOrderItems as $index => $customOrderItem)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    <img height="40" src="{{ FirebaseStorageService::getImageUrl($customOrderItem->image_path) }}" alt="">
                </td>
                <td>{{ $customOrderItem->product_name }}</td>
                <td>{{ $customOrderItem->quantity }}</td>
                <td>{{ '$' . number_format($customOrderItem->total_price) }}</td>
            </tr>
            @php
                $total += $customOrderItem->total_price;
            @endphp
        @endforeach
        <tr>
            <td colspan="2"></td>
            <td colspan="2">TOTAL</td>
            <td>{{ '$' . number_format($total) }}</td>
        </tr>
    </tbody>
</table>
