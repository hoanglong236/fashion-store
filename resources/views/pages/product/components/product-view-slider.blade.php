<div class="aa-product-view-slider">
    <div class="simpleLens-gallery-container">
        <div class="simpleLens-container">
            <div class="product-view-image">
                <img src="{{ FirebaseStorageService::getImageUrl($product->main_image_path) }}" class="simpleLens-big-image">
            </div>
        </div>
        <div class="product-view-slider-wrapper">
            <ul class="product-images-slider">
                @foreach ($productImages as $productImage)
                    <li>
                        <img height="50" src="{{ FirebaseStorageService::getImageUrl($productImage->image_path) }}" alt="java img">
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('assets/js/product-images-slider.js') }}"></script>
@endpush
