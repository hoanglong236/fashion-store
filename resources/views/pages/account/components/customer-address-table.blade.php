<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Address</th>
            <th scope="col">Type</th>
            <th scope="col">Default</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customerAddresses as $index => $customerAddress)
            <tr>
                <th scope="row">{{ $index + 1 }}</th>
                <td>{{ $customerAddress->specific_address .
                    ', ' .
                    $customerAddress->ward .
                    ', ' .
                    $customerAddress->district .
                    ', ' .
                    $customerAddress->city }}
                </td>
                <td>{{ $customerAddress->address_type }}</td>
                <td>
                    <form action="{{ route('customer.info.change.default.address', $customerAddress->id) }}"
                        method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group text-center">
                            <input class="form-input" type="radio" @checked($customerAddress->default_flag)
                                onchange="this.form.submit()">
                        </div>
                    </form>
                </td>
                <td>
                    <form action="{{ route('customer.info.address.delete', $customerAddress->id) }}" method="post"
                        onsubmit="return confirm('Are you sure you want to delete your address?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
