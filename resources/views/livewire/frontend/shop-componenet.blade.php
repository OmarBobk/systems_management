<div>
    @push('shop_scripts')
        <script src="{{asset('assets/plugins/ion-rangeSlider/ion.rangeSlider.min.js')}}"></script>
        <script src="{{asset('assets/js/custom/custom-ecommerce-shop-page.js')}}"></script>
    @endpush

    @push('shop_styles')
        <link href="{{asset('assets/plugins/ion-rangeSlider/ion.rangeSlider.css')}}" rel="stylesheet" type="text/css">
        <style>
            .searchbar input[type=search] {
                background-color: rgba(129, 167, 205, 0.1);
                color: #263a5b;
                font-size: 16px;
                padding-left: 20px;
                border: none;
                border-radius: 3px 0 0 3px;
            }
            .searchbar .input-group-append {margin-left:0;}
            .searchbar .btn {
                background-color: rgba(129, 167, 205, 0.1);
                color: #263a5b;
                font-weight: 700;
                font-size: 18px;
                font-weight: 700;
                border-radius: 0 3px 3px 0;
                padding: 3px 15px 3px 5px;
                box-shadow: none;
            }
            .searchbar .btn img {
                width: 20px;
                margin-top: -3px;
                filter: invert(0.6) sepia(1) saturate(1) hue-rotate(
                    185deg);
            }
        </style>
@endpush
<!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Start Sidebar -->
        {{--            <div class="col-lg-4 col-xl-3">--}}
        {{--                <div class="card m-b-30">--}}
        {{--                    <div class="card-header">--}}
        {{--                        <div class="row align-items-center">--}}
        {{--                            <div class="col-9">--}}
        {{--                                <h5 class="card-title mb-0">Categories</h5>--}}
        {{--                            </div>--}}
        {{--                            <div class="col-3">--}}
        {{--                                <ul class="list-inline-group text-right mb-0 pl-0">--}}
        {{--                                    <li class="list-inline-item mr-0 font-12">--}}
        {{--                                        <a href="#">--}}
        {{--                                            <i class="feather icon-refresh-cw font-16 text-primary ml-1"></i>--}}
        {{--                                        </a>--}}
        {{--                                    </li>--}}
        {{--                                </ul>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                    <div class="card-body">--}}
        {{--                        <div class="custom-control custom-checkbox">--}}
        {{--                            <input type="checkbox" class="custom-control-input"--}}
        {{--                                   id="all" wire:model="categories_filter.all" checked>--}}
        {{--                            <label class="custom-control-label" for="all">All</label>--}}
        {{--                        </div>--}}
        {{--                        @forelse($this->categories as $category)--}}
        {{--                            <div class="custom-control custom-checkbox">--}}
        {{--                                <input type="checkbox" class="custom-control-input"--}}
        {{--                                       id="{{$category->name}}" wire:model="categories_filter.{{$category->id}}">--}}
        {{--                                <label class="custom-control-label" for="{{$category->name}}">{{$category->name}}</label>--}}
        {{--                            </div>--}}
        {{--                        @empty--}}
        {{--                            Not Found--}}
        {{--                        @endforelse--}}
        {{--                        <button wire:click="test">click</button>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--                <div class="card m-b-30">--}}
        {{--                    <div class="card-header">--}}
        {{--                        <div class="row align-items-center">--}}
        {{--                            <div class="col-9">--}}
        {{--                                <h5 class="card-title mb-0">Price</h5>--}}
        {{--                            </div>--}}
        {{--                            <div class="col-3">--}}
        {{--                                <ul class="list-inline-group text-right mb-0 pl-0">--}}
        {{--                                    <li class="list-inline-item mr-0 font-12"><a href="#"><i class="feather icon-refresh-cw font-16 text-primary ml-1"></i></a></li>--}}
        {{--                                </ul>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                    <div class="card-body">--}}
        {{--                        <input id="range-slider-prefix">--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--                <div class="card m-b-30">--}}
        {{--                    <div class="card-header">--}}
        {{--                        <div class="row align-items-center">--}}
        {{--                            <div class="col-9">--}}
        {{--                                <h5 class="card-title mb-0">Colors</h5>--}}
        {{--                            </div>--}}
        {{--                            <div class="col-3">--}}
        {{--                                <ul class="list-inline-group text-right mb-0 pl-0">--}}
        {{--                                    <li class="list-inline-item mr-0 font-12"><a href="#"><i class="feather icon-refresh-cw font-16 text-primary ml-1"></i></a></li>--}}
        {{--                                </ul>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                    <div class="card-body pt-3">--}}
        {{--                        <div class="custom-checkbox-button">--}}
        {{--                            <div class="form-check-inline checkbox-primary">--}}
        {{--                                <input type="checkbox" id="customCheckboxInline5" name="customCheckboxInline2" checked>--}}
        {{--                                <label for="customCheckboxInline5"></label>--}}
        {{--                            </div>--}}
        {{--                            <div class="form-check-inline checkbox-secondary">--}}
        {{--                                <input type="checkbox" id="customCheckboxInline6" name="customCheckboxInline2">--}}
        {{--                                <label for="customCheckboxInline6"></label>--}}
        {{--                            </div>--}}
        {{--                            <div class="form-check-inline checkbox-success">--}}
        {{--                                <input type="checkbox" id="customCheckboxInline7" name="customCheckboxInline2">--}}
        {{--                                <label for="customCheckboxInline7"></label>--}}
        {{--                            </div>--}}
        {{--                            <div class="form-check-inline checkbox-danger">--}}
        {{--                                <input type="checkbox" id="customCheckboxInline8" name="customCheckboxInline2">--}}
        {{--                                <label for="customCheckboxInline8"></label>--}}
        {{--                            </div>--}}
        {{--                            <div class="form-check-inline checkbox-warning">--}}
        {{--                                <input type="checkbox" id="customCheckboxInline9" name="customCheckboxInline2">--}}
        {{--                                <label for="customCheckboxInline9"></label>--}}
        {{--                            </div>--}}
        {{--                            <div class="form-check-inline checkbox-info">--}}
        {{--                                <input type="checkbox" id="customCheckboxInline10" name="customCheckboxInline2">--}}
        {{--                                <label for="customCheckboxInline10"></label>--}}
        {{--                            </div>--}}
        {{--                            <div class="form-check-inline checkbox-light">--}}
        {{--                                <input type="checkbox" id="customCheckboxInline11" name="customCheckboxInline2">--}}
        {{--                                <label for="customCheckboxInline11"></label>--}}
        {{--                            </div>--}}
        {{--                            <div class="form-check-inline checkbox-dark">--}}
        {{--                                <input type="checkbox" id="customCheckboxInline12" name="customCheckboxInline2">--}}
        {{--                                <label for="customCheckboxInline12"></label>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--                <div class="card m-b-30">--}}
        {{--                    <div class="card-header">--}}
        {{--                        <div class="row align-items-center">--}}
        {{--                            <div class="col-9">--}}
        {{--                                <h5 class="card-title mb-0">Warranty Type</h5>--}}
        {{--                            </div>--}}
        {{--                            <div class="col-3">--}}
        {{--                                <ul class="list-inline-group text-right mb-0 pl-0">--}}
        {{--                                    <li class="list-inline-item mr-0 font-12"><a href="#"><i class="feather icon-refresh-cw font-16 text-primary ml-1"></i></a></li>--}}
        {{--                                </ul>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                    <div class="card-body">--}}
        {{--                        <div class="custom-control custom-radio">--}}
        {{--                            <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" checked="">--}}
        {{--                            <label class="custom-control-label" for="customRadio1">1 Year Warranty</label>--}}
        {{--                        </div>--}}
        {{--                        <div class="custom-control custom-radio">--}}
        {{--                            <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">--}}
        {{--                            <label class="custom-control-label" for="customRadio2">Membership Warranty</label>--}}
        {{--                        </div>--}}
        {{--                        <div class="custom-control custom-radio">--}}
        {{--                            <input type="radio" id="customRadio4" name="customRadio" class="custom-control-input">--}}
        {{--                            <label class="custom-control-label v-a-m" for="customRadio4">On Site Warranty</label>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--                <div class="card m-b-30">--}}
        {{--                    <div class="card-header">--}}
        {{--                        <div class="row align-items-center">--}}
        {{--                            <div class="col-9">--}}
        {{--                                <h5 class="card-title mb-0">Tags</h5>--}}
        {{--                            </div>--}}
        {{--                            <div class="col-3">--}}
        {{--                                <ul class="list-inline-group text-right mb-0 pl-0">--}}
        {{--                                    <li class="list-inline-item mr-0 font-12"><a href="#"><i class="feather icon-refresh-cw font-16 text-primary ml-1"></i></a></li>--}}
        {{--                                </ul>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                    <div class="card-body">--}}
        {{--                        <div class="badge-list">--}}
        {{--                            <a href="#" class="badge badge-light">New</a>--}}
        {{--                            <a href="#" class="badge badge-light">Latest</a>--}}
        {{--                            <a href="#" class="badge badge-light">Featured</a>--}}
        {{--                            <a href="#" class="badge badge-light">Popular</a>--}}
        {{--                            <a href="#" class="badge badge-light">Trending</a>--}}
        {{--                            <a href="#" class="badge badge-light">Sale</a>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        <!-- End Sidebar -->

            <!-- Start Products -->
            <div class="col-12 col-xl-12">

                <!-- Start Products -->
                <div class="card m-b-30">
                    {{--                    <div class="card-header">--}}
                    {{--                        <h5 class="card-title">Products</h5>--}}
                    {{--                    </div>--}}
                    <div class="card-body">

                        <!-- Start Filters -->
                        <div class="row align-items-center justify-between ecommerce-sortby">
                            <div class="col-md-12 col-lg-12 col-xl-3 align-self-center">
                                <div class="togglebar w-full">
                                    <ul class="list-inline mb-0 d-flex justify-between ">
                                        {{--Search Field--}}
                                        <li class="list-inline-item w-full">
                                            <div class="searchbar">
                                                <div class="input-group">
                                                    <input type="search" class="form-control"
                                                           wire:model="searchKeyword"
                                                           placeholder="{{__('header.search')}}" aria-label="Search"
                                                           aria-describedby="button-addon2">
                                                    <div class="input-group-append">
                                                        <button class="btn" type="submit" id="button-addon2"><img src="{{asset('assets/images/svg-icon/search.svg')}}" class="img-fluid" alt="search"></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>

                            <!-- Start col -->
                            <div class="col-md-12 col-lg-12 col-xl-3 mt-3">
                                <select class="!w-full form-control" id="productSortBy" wire:model="productSortBy">
                                    <option value="price.asc">Price - Low to High</option>
                                    <option value="price.desc">Price - High to Low</option>
                                    <option value="updated_at.asc">Newest</option>
                                    {{--                                    <option value="">Popularity</option>--}}
                                    {{--                                    <option value="">Average Rating</option>--}}
                                </select>
                            </div>
                            <!-- End col -->


                        </div>
                        <!-- End Filters -->



                        <!-- Start Products -->
                        <div class="row">
                            <!-- Start col -->
                            @forelse($paginated as $product)
                                <div class="col-6 col-xl-3 col-md-4">
                                    <div class="product-bar m-b-30">
                                        <div class="product-head">
                                            <a href="#">
                                                <img
                                                    src="{{\Illuminate\Support\Facades\Vite::asset('resources/images/products/'.$product->serial.'.jpg')}}"
                                                    class="img-fluid !h-56 sm:!h-72 w-full object-cover" alt="product"></a>
                                            <p><span class="badge badge-info text-sm sm:font-14">Product Code: {{$product->code}}</span></p>
                                        </div>
                                        <div class="product-body py-3">
                                            {{--                                            <div class="row align-items-center">--}}
                                            {{--                                                <div class="col-12">--}}
                                            {{--                                                    <div class="d-inline-block">--}}
                                            {{--                                                        <span class="text-uppercase font-12 f-w-6">Watch</span>--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                    <div class="d-inline-block float-right">--}}
                                            {{--                                                        <i class="feather icon-star text-warning"></i>--}}
                                            {{--                                                        <i class="feather icon-star text-warning"></i>--}}
                                            {{--                                                        <i class="feather icon-star text-warning"></i>--}}
                                            {{--                                                        <i class="feather icon-star"></i>--}}
                                            {{--                                                        <i class="feather icon-star"></i>--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                </div>--}}
                                            {{--                                            </div>--}}
                                            <div class="row align-items-center">
                                                <div class="col-12">
                                                    <h6 class="mt-1 mb-3">{{$product->name}}</h6>
                                                </div>
                                            </div>
                                            <div class="row align-items-center">
                                                <div class="col-6">
                                                    <div class="text-left">
                                                        <h5 class="f-w-7 mb-0">{{round($product->price / 1000)}} TL</h5>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="text-right">
                                                        <button type="button" class="btn btn-primary-rgba font-18"><i class="fa fa-chevron-right"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                Not Found
                            @endforelse
                        </div>
                        <!-- Start Products -->
                    </div>
                </div>
                {{--End Products--}}

                {{--Start Pagination--}}
                <div class="card m-b-30">
                    <div class="card-body ecommerce-pagination">
                        <div class="row align-items-center">
                            <div class="col-lg-12 col-xl-6">
                                <p>Showing 1 to 2 of 12 entries</p>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination mb-0">
                                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                {{--End Pagination--}}
            </div>
            <!-- End Products -->
        </div>
        <!-- End row -->
    </div>
    <!-- End Contentbar -->
</div>
