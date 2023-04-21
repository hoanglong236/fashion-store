<div class="box-warranty-info">
    <div class="box-title ml-2">
        <h4>Product information</h4>
    </div>
    <div class="box-content warranty-info">
        <div class="item-warranty-info">
            <div class="icon">
                <img src="{{ asset('assets/img/phone.png') }}" alt="">
            </div>
            <div class="description">New, full accessories from the manufacturer</div>
        </div>
        <div class="item-warranty-info">
            <div class="icon">
                <img src="{{ asset('assets/img/box.png') }}" alt="">
            </div>
            <div class="description">
                Machine <br>
                Adapter <br>
                USB Type-C Cable <br>
                Instruction document <br>
                Product warranty card <br>
            </div>
        </div>
        <div class="item-warranty-info">
            <div class="icon">
                <img src="{{ asset('assets/img/shield.png') }}" alt="">
            </div>
            <div class="description">
                {{ $product->warranty_period }}-month warranty at Genuine service center.
                1 to 1 exchange in 30 days if there is a hardware defect from the manufacturer.
                <a class="primary-link" target="_blank" href="#warranty-policy">(View details)</a>
            </div>
        </div>
    </div>
</div>
