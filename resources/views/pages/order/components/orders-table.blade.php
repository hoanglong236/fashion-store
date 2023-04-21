<table class="table orders-table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Delivery address</th>
            <th scope="col">Total amount</th>
            <th scope="col">Status</th>
            <th scope="col">Created at</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customOrders as $customOrder)
            <tr>
                <td>{{ $customOrder->id }}</td>
                <td>{{ $customOrder->delivery_address }}</td>
                <td>${{ number_format($customOrder->total) }}</td>
                <td>
                    <span @class([
                        'complete-status' =>
                            $customOrder->status === OrderStatusConstants::COMPLETED,
                        'cancel-status' => $customOrder->status === OrderStatusConstants::CANCELLED,
                    ])>
                        {{ $customOrder->status }}
                    </span>
                </td>
                <td>{{ $customOrder->created_at }}</td>
                <td>
                    <a href="{{ route('order.details', $customOrder->id) }}"
                        class="btn btn-primary btn-sm mb-2">Details</a>
                    @if (
                        $customOrder->status !== OrderStatusConstants::COMPLETED &&
                            $customOrder->status !== OrderStatusConstants::CANCELLED)
                        <form action="{{ route('order.cancel', $customOrder->id) }}"
                            onsubmit="return confirm('Are you sure you want to cancel your order?')" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
