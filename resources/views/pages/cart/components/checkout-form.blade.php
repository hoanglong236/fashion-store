<form action="{{ route('order.place') }}" method="post">
    @csrf
    @if ($errors->any())
        <div class="alert alert-danger mt-2" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="panel panel-default address-panel-wrapper">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#addressCollapse" aria-expanded="true">
                    Shippping Address
                </a>
            </h4>
        </div>
        <div id="addressCollapse" class="panel-collapse collapse in" aria-expanded="true">
            <div class="panel-body customer-address-panel">
                @foreach ($customerAddresses as $index => $customerAddress)
                    @php
                        $deliveryAddress = $customerAddress->specific_address . ', ' . $customerAddress->ward . ', ' . $customerAddress->district . ', ' . $customerAddress->city;
                    @endphp
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="{{ 'deliveryAddress' . $index }}"
                            name="deliveryAddress" value="{{ $deliveryAddress }}" @checked($customerAddress->default_flag)>
                        <label class="form-check-label" for="{{ 'deliveryAddress' . $index }}">
                            {{ $deliveryAddress }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="panel panel-default payment-panel-wrapper">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#paymentCollapse" aria-expanded="true">
                    Payment Method
                </a>
            </h4>
        </div>
        <div id="paymentCollapse" class="panel-collapse collapse in" aria-expanded="true">
            <div class="panel-body customer-address-panel">
                @foreach ($paymentMethods as $index => $paymentMethod)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="{{ 'paymentMethod' . $index }}"
                            name="paymentMethod" value={{ $paymentMethod }} @checked($index === 0)>
                        <label class="form-check-label" for="{{ 'paymentMethod' . $index }}">
                            {{ $paymentMethod }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @foreach ($customCartItems as $customCartItem)
        <input type="hidden" name="cartItemIds[]" value="{{ $customCartItem->id }}" readonly>
    @endforeach

    <button class="btn action-btn place-order-btn" type="submit">Place order</button>
</form>
