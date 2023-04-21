<table class="table order-info-table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" colspan="2">Order Info</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>ID</td>
            <td>{{ $customOrder->id }}</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Status</td>
            <td>{{ $customOrder->status }}</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Address</td>
            <td>{{ $customOrder->delivery_address }}</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Created at</td>
            <td>{{ $customOrder->created_at }}</td>
        </tr>
        <tr>
            <td>5</td>
            <td>Updated at</td>
            <td>{{ $customOrder->updated_at }}</td>
        </tr>
    </tbody>
</table>
