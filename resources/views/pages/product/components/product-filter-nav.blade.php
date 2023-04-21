<aside class="aa-sidebar">
    <div class="aa-sidebar-widget">
        <h3>Brands</h3>
        <div class="brands-tag">
            @foreach ($brands as $brand)
                <a href="#">{{ $brand->name }}</a>
            @endforeach
        </div>
    </div>
    <div class="aa-sidebar-widget">
        <h3>Sort by</h3>
        <ul class="aa-catg-nav">
            @foreach ($sorterOptions as $sorterOption)
                <li><a href="#">{{ $sorterOption }}</a></li>
            @endforeach
        </ul>
    </div>

    <div class="aa-sidebar-widget">
        <h3>Best sellers</h3>
        <div class="aa-recently-views">
            <ul>
                @foreach ($bestSellerProducts as $product)
                    <li>
                        <a href="#" class="aa-cartbox-img"><img alt="img"
                                src="{{ FirebaseStorageService::getImageUrl($product->main_image_path) }}"></a>
                        <div class="aa-cartbox-info">
                            <h4><a href="{{ route('product.details', $product->slug) }}">{{ $product->name }}</a></h4>
                            <div class="product-price-wrapper">
                                @if ($product->discount_percent === 0)
                                    <span>{{ '$' . number_format($product->price) }}</span>
                                @else
                                    <span>{{ '$' . number_format($product->price * (1 - $product->discount_percent / 100)) }}</span>
                                    <span><del>{{ '$' . number_format($product->price) }}</del></span>
                                @endif
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</aside>
