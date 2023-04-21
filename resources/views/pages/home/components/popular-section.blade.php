<section id="aa-popular-category">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="aa-popular-category-area">
                        <!-- Product navigation -->
                        <ul class="nav nav-tabs aa-products-tab">
                            <li class="active"><a href="#popular" data-toggle="tab">Popular</a></li>
                            <li><a href="#featured" data-toggle="tab">Featured</a></li>
                            <li><a href="#latest" data-toggle="tab">Latest</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- Popular products -->
                            <div class="tab-pane fade in active" id="popular">
                                @include('shared.components.products-list', [
                                    'products' => $data['popularProducts'],
                                ])
                                {{-- <a class="aa-browse-btn" href="#">
                                    Browse all Product <span class="fa fa-long-arrow-right"></span>
                                </a> --}}
                            </div>
                            <!-- Popular products END -->

                            <!-- Featured products -->
                            <div class="tab-pane fade" id="featured">
                                @include('shared.components.products-list', [
                                    'products' => $data['featuredProducts'],
                                ])
                                {{-- <a class="aa-browse-btn" href="#">
                                    Browse all Product <span class="fa fa-long-arrow-right"></span>
                                </a> --}}
                            </div>
                            <!-- Featured products END -->

                            <!-- Latest products -->
                            <div class="tab-pane fade" id="latest">
                                @include('shared.components.products-list', [
                                    'products' => $data['latestProducts'],
                                ])
                                {{-- <a class="aa-browse-btn" href="#">
                                    Browse all Product <span class="fa fa-long-arrow-right"></span>
                                </a> --}}
                            </div>
                            <!-- Latest products END -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
