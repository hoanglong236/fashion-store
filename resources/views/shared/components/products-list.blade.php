<div class="product-card-wrapper">
    @foreach ($products as $product)
        @include('shared.components.product-card', [
            'product' => $product,
        ])
    @endforeach
</div>
