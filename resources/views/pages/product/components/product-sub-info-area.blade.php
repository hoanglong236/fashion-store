<div class="box-warranty-info">
    <div class="box-title ml-2">
        <h4>Product information</h4>
    </div>
    <div class="box-content warranty-info">
        <div class="item-warranty-info">
            <div class="icon">
                <img src="{{ asset('assets/img/bags.png') }}" alt="">
            </div>
            <div class="description">Good product quality, has undergone rigorous testing</div>
        </div>
        <div class="item-warranty-info">
            <div class="icon">
                <img src="{{ asset('assets/img/shield.png') }}" alt="">
            </div>
            <div class="description">
                {{ $product->warranty_period }}-month return and exchange, if there is a problem with product quality.
                <a class="primary-link" target="_blank" href="#warranty-policy">(View details)</a>
            </div>
        </div>
    </div>
</div>
