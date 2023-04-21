<section id="aa-product">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="aa-product-area">
                        <div class="aa-product-inner">
                            <!-- Product navigation -->
                            <ul class="nav nav-tabs aa-products-tab">
                                @foreach ($data['topCategories'] as $index => $category)
                                    <li @class(['active' => $index === 0])>
                                        <a href="#{{ $category->slug }}" data-toggle="tab">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                @foreach ($data['topCategories'] as $index => $category)
                                    <div @class(['tab-pane fade', 'in active' => $index === 0]) id="{{ $category->slug }}">
                                        @include('shared.components.products-list', [
                                            'products' => $data['productsOfTopCategories'][$category->id],
                                        ])
                                        {{-- <a class="aa-browse-btn" href="#">
                                            Browse all Product <span class="fa fa-long-arrow-right"></span>
                                        </a> --}}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
