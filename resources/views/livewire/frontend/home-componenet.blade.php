<div>

    @push('homepage_styles')
        <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/owl.theme.default.css')}}">
        <style>
            .owl-theme .owl-nav.disabled + .owl-dots {
                margin-top: 0;
            }
        </style>
    @endpush

    @push('homepage_scripts')
        <script src="{{asset('assets/plugins/owl/owl.carousel.js')}}"></script>
        <script>
            $(document).ready(function () {
                var owl = $('.owl-carousel');
                owl.owlCarousel({
                    items: 4,
                    loop: true,
                    margin: 10,
                    autoplay: true,
                    autoplayTimeout: 2000,
                    autoplayHoverPause: true,

                    nav: false,
                    responsive: {
                        0: {
                            items: 2
                        },
                        600: {
                            items: 3
                        },
                        1000: {
                            items: 4
                        }
                    }
                });
            })
        </script>
    @endpush
<!-- Start Contentbar -->

    {{--Slider--}}
    <div class="lg:mt-36 mt-[4.8rem] md:mt-[4.8rem] sm:mt-[4.80rem]">
        <div class="relative">
            <img
                src="https://images.pexels.com/photos/3747463/pexels-photo-3747463.jpeg?auto=compress&amp;cs=tinysrgb&amp;dpr=2&amp;h=750&amp;w=1260"
                class="absolute inset-0 object-cover w-full h-full" alt=""/>
            <div class="relative bg-gray-900 bg-opacity-75">
                <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
                    <div class="flex flex-col items-center justify-between xl:flex-row">
                        <div class="w-full max-w-xl mb-12 xl:mb-0 xl:pr-16 xl:w-7/12">
                            <h2 class="max-w-lg mb-6 font-sans text-3xl font-bold tracking-tight
                             text-white sm:text-[3.25rem] sm:leading-none">
                                Suggest a Product? <br class="hidden md:block"/>
                                {{--                                jumps over a <span class="text-teal-accent-400">lazy dog</span>--}}
                            </h2>
                            <p class="max-w-xl mb-4 text-base text-gray-400 md:text-lg">
                                Didn't found your product?<br class="hidden md:block"/>
                                Send us a message, and we will add it to CXC now.
                            </p>
                            {{--                            <a href="/" aria-label=""--}}
                            {{--                               class="inline-flex items-center font-semibold tracking-wider transition-colors duration-200 text-teal-accent-400 hover:text-teal-accent-700">--}}
                            {{--                                Learn more--}}
                            {{--                                <svg class="inline-block w-3 ml-2" fill="currentColor" viewBox="0 0 12 12">--}}
                            {{--                                    <path--}}
                            {{--                                        d="M9.707,5.293l-5-5A1,1,0,0,0,3.293,1.707L7.586,6,3.293,10.293a1,1,0,1,0,1.414,1.414l5-5A1,1,0,0,0,9.707,5.293Z"></path>--}}
                            {{--                                </svg>--}}
                            {{--                            </a>--}}
                        </div>
                        <div class="w-full max-w-xl xl:px-8 xl:w-5/12">
                            <div class="bg-white rounded shadow-2xl p-7 sm:p-10">
                                <h3 class="mb-4 text-xl font-semibold sm:text-center sm:mb-6 sm:text-2xl">
                                    Request Your Product Now!
                                </h3>
                                <form>
                                    <div class="mb-1 sm:mb-2">
                                        <label for="productName" class="inline-block mb-1 font-medium">Product Name</label>
                                        <input
                                            placeholder="Charger, Headset ..etc"
                                            required=""
                                            type="text"
                                            class="placeholder:opacity-40 flex-grow w-full h-12 px-4 mb-2 transition duration-200 bg-white border border-gray-300 rounded shadow-sm appearance-none focus:border-deep-purple-accent-400 focus:outline-none focus:shadow-outline"
                                            id="productName"
                                            name="productName"
                                        />
                                    </div>
                                    <div class="mb-1 sm:mb-2">
                                        <label for="description" class="inline-block mb-1 font-medium">Description</label>
                                        <textarea name="description" id="description"
                                                  class="flex-grow placeholder:opacity-40 w-full px-4 mb-2 transition duration-200 bg-white border border-gray-300 rounded shadow-sm appearance-none focus:border-deep-purple-accent-400 focus:outline-none focus:shadow-outline"
                                                  cols="30" rows="6" placeholder="Product Description"></textarea>
                                    </div>
                                    <div class="mb-1 sm:mb-2">
                                        <label for="email" class="inline-block mb-1 font-medium">E-mail</label>
                                        <input
                                            placeholder="john.doe@example.org"
                                            required=""
                                            type="text"
                                            class="flex-grow placeholder:opacity-40 w-full h-12 px-4 mb-2 transition duration-200 bg-white border border-gray-300 rounded shadow-sm appearance-none focus:border-deep-purple-accent-400 focus:outline-none focus:shadow-outline"
                                            id="email"
                                            name="email"
                                        />
                                    </div>
                                    <div class="mb-1 sm:mb-2">
                                        <label for="phone" class="inline-block mb-1 font-medium">Phone</label>
                                        <input
                                            placeholder="535 340 25 39"
                                            required=""
                                            type="text"
                                            class="flex-grow w-full h-12 px-4 mb-2 transition
                                            duration-200 bg-white border border-gray-300 rounded
                                            shadow-sm appearance-none focus:border-deep-purple-accent-400
                                            placeholder:opacity-40
                                            focus:outline-none focus:shadow-outline"
                                            id="phone"
                                            name="phone"
                                        />
                                    </div>
                                    <div class="mt-4 mb-2 sm:mb-4">
                                        <button
                                            type="submit"
                                            class="inline-flex items-center
                                            justify-center w-full h-12 px-6
                                            font-medium tracking-wide text-white
                                            transition duration-200 rounded shadow-md
                                            bg-green-400 hover:bg-green-700
                                            focus:shadow-outline focus:outline-none"
                                        >
                                            Send
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="contentbar px-0">
        <!-- Start row -->
        <div class="row">
            <!-- Start On sale -->
            <div class="col-lg-8 col-xl-12">
                <div class="card m-b-30">
                    <div class="card-header p-6">
                        <h5 class="card-title !text-[30px]"
                            style="font-weight: 600;">
                            On Sale
                        </h5>
                    </div>

                    <div class="card-body pt-0">
                        <!-- Start row -->
                        <div class="owl-carousel owl-theme" style="z-index: unset;">
                            <!-- Start col -->
                            <div class="product-bar m-b-25">
                                <div class="product-head">
                                    <a href="#"><img src="assets/images/ecommerce/product_img_01.jpg" class="img-fluid"
                                                     alt="product"></a>
                                    <p><span class="badge badge-success font-14">25% off</span></p>
                                </div>
                                <div class="product-body pt-3">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <div class="d-inline-block">
                                                <span class="text-uppercase font-12 f-w-6">Watch</span>
                                            </div>
                                            <div class="d-inline-block float-right">
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star"></i>
                                                <i class="feather icon-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <h6 class="mt-1 mb-3">Apple Watch</h6>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <div class="text-left">
                                                <h5 class="f-w-7 mb-0"><sup class="font-14">$</sup>350</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <button type="button" class="btn btn-primary-rgba font-18"><i
                                                        class="feather icon-shopping-bag"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End col -->
                            <!-- Start col -->
                            <div class="product-bar m-b-25">
                                <div class="product-head">
                                    <a href="#"><img src="assets/images/ecommerce/product_img_02.jpg" class="img-fluid"
                                                     alt="product"></a>
                                    <p><span class="badge badge-primary font-14">New</span></p>
                                </div>
                                <div class="product-body pt-3">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <div class="d-inline-block">
                                                <span class="text-uppercase font-12 f-w-6">Audio</span>
                                            </div>
                                            <div class="d-inline-block float-right">
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star"></i>
                                                <i class="feather icon-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <h6 class="mt-1 mb-3">Apple Air Pod</h6>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <div class="text-left">
                                                <h5 class="f-w-7 mb-0"><sup class="font-14">$</sup>120</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <button type="button" class="btn btn-primary-rgba font-18"><i
                                                        class="feather icon-shopping-bag"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End col -->
                            <!-- Start col -->
                            <div class="product-bar m-b-25">
                                <div class="product-head">
                                    <a href="#"><img src="assets/images/ecommerce/product_img_03.jpg" class="img-fluid"
                                                     alt="product"></a>
                                    <p><span class="badge badge-danger font-14">Price Drop</span></p>
                                </div>
                                <div class="product-body pt-3">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <div class="d-inline-block">
                                                <span class="text-uppercase font-12 f-w-6">Phone</span>
                                            </div>
                                            <div class="d-inline-block float-right">
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star"></i>
                                                <i class="feather icon-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <h6 class="mt-1 mb-3">Apple iPhone XR</h6>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <div class="text-left">
                                                <h5 class="f-w-7 mb-0"><sup class="font-14">$</sup>1110</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <button type="button" class="btn btn-primary-rgba font-18"><i
                                                        class="feather icon-shopping-bag"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End col -->
                            <!-- Start col -->
                            <div class="product-bar m-b-25">
                                <div class="product-head">
                                    <a href="#"><img src="assets/images/ecommerce/product_img_04.jpg" class="img-fluid"
                                                     alt="product"></a>
                                    <p><span class="badge badge-success font-14">Sale</span></p>
                                </div>
                                <div class="product-body pt-3">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <div class="d-inline-block">
                                                <span class="text-uppercase font-12 f-w-6">Tablet</span>
                                            </div>
                                            <div class="d-inline-block float-right">
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star"></i>
                                                <i class="feather icon-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <h6 class="mt-1 mb-3">Apple iPad Mini</h6>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <div class="text-left">
                                                <h5 class="f-w-7 mb-0"><sup class="font-14">$</sup>430</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <button type="button" class="btn btn-primary-rgba font-18"><i
                                                        class="feather icon-shopping-bag"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End col -->
                            <!-- Start col -->
                            <div class="product-bar m-b-25">
                                <div class="product-head">
                                    <a href="#"><img src="assets/images/ecommerce/product_img_05.jpg" class="img-fluid"
                                                     alt="product"></a>
                                    <p><span class="badge badge-warning font-14">Trending</span></p>
                                </div>
                                <div class="product-body pt-3">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <div class="d-inline-block">
                                                <span class="text-uppercase font-12 f-w-6">Laptop</span>
                                            </div>
                                            <div class="d-inline-block float-right">
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star"></i>
                                                <i class="feather icon-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <h6 class="mt-1 mb-3">Apple Mac Book Air</h6>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <div class="text-left">
                                                <h5 class="f-w-7 mb-0"><sup class="font-14">$</sup>1700</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <button type="button" class="btn btn-primary-rgba font-18"><i
                                                        class="feather icon-shopping-bag"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End col -->
                            <!-- Start col -->
                            <div class="product-bar m-b-25">
                                <div class="product-head">
                                    <a href="#"><img src="assets/images/ecommerce/product_img_06.jpg" class="img-fluid"
                                                     alt="product"></a>
                                    <p><span class="badge badge-info font-14">Popular</span></p>
                                </div>
                                <div class="product-body pt-3">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <div class="d-inline-block">
                                                <span class="text-uppercase font-12 f-w-6">Desktop</span>
                                            </div>
                                            <div class="d-inline-block float-right">
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star"></i>
                                                <i class="feather icon-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <h6 class="mt-1 mb-3">Apple Desktop</h6>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <div class="text-left">
                                                <h5 class="f-w-7 mb-0"><sup class="font-14">$</sup>2100</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <button type="button" class="btn btn-primary-rgba font-18"><i
                                                        class="feather icon-shopping-bag"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End col -->
                            <!-- Start col -->
                            <div class="product-bar m-b-25">
                                <div class="product-head">
                                    <a href="#"><img src="assets/images/ecommerce/product_img_06.jpg" class="img-fluid"
                                                     alt="product"></a>
                                    <p><span class="badge badge-info font-14">Popular</span></p>
                                </div>
                                <div class="product-body pt-3">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <div class="d-inline-block">
                                                <span class="text-uppercase font-12 f-w-6">Desktop</span>
                                            </div>
                                            <div class="d-inline-block float-right">
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star"></i>
                                                <i class="feather icon-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <h6 class="mt-1 mb-3">Apple Desktop</h6>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <div class="text-left">
                                                <h5 class="f-w-7 mb-0"><sup class="font-14">$</sup>2100</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <button type="button" class="btn btn-primary-rgba font-18"><i
                                                        class="feather icon-shopping-bag"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End col -->
                            <!-- Start col -->
                            <div class="product-bar m-b-25">
                                <div class="product-head">
                                    <a href="#"><img src="assets/images/ecommerce/product_img_06.jpg" class="img-fluid"
                                                     alt="product"></a>
                                    <p><span class="badge badge-info font-14">Popular</span></p>
                                </div>
                                <div class="product-body pt-3">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <div class="d-inline-block">
                                                <span class="text-uppercase font-12 f-w-6">Desktop</span>
                                            </div>
                                            <div class="d-inline-block float-right">
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star"></i>
                                                <i class="feather icon-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <h6 class="mt-1 mb-3">Apple Desktop</h6>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <div class="text-left">
                                                <h5 class="f-w-7 mb-0"><sup class="font-14">$</sup>2100</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <button type="button" class="btn btn-primary-rgba font-18"><i
                                                        class="feather icon-shopping-bag"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End col -->
                            <!-- Start col -->
                            <div class="product-bar m-b-25">
                                <div class="product-head">
                                    <a href="#"><img src="assets/images/ecommerce/product_img_06.jpg" class="img-fluid"
                                                     alt="product"></a>
                                    <p><span class="badge badge-info font-14">Popular</span></p>
                                </div>
                                <div class="product-body pt-3">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <div class="d-inline-block">
                                                <span class="text-uppercase font-12 f-w-6">Desktop</span>
                                            </div>
                                            <div class="d-inline-block float-right">
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star"></i>
                                                <i class="feather icon-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <h6 class="mt-1 mb-3">Apple Desktop</h6>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <div class="text-left">
                                                <h5 class="f-w-7 mb-0"><sup class="font-14">$</sup>2100</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <button type="button" class="btn btn-primary-rgba font-18"><i
                                                        class="feather icon-shopping-bag"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End col -->
                            <!-- Start col -->
                            <div class="product-bar m-b-25">
                                <div class="product-head">
                                    <a href="#"><img src="assets/images/ecommerce/product_img_06.jpg" class="img-fluid"
                                                     alt="product"></a>
                                    <p><span class="badge badge-info font-14">Popular</span></p>
                                </div>
                                <div class="product-body pt-3">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <div class="d-inline-block">
                                                <span class="text-uppercase font-12 f-w-6">Desktop</span>
                                            </div>
                                            <div class="d-inline-block float-right">
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star"></i>
                                                <i class="feather icon-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <h6 class="mt-1 mb-3">Apple Desktop</h6>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <div class="text-left">
                                                <h5 class="f-w-7 mb-0"><sup class="font-14">$</sup>2100</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <button type="button" class="btn btn-primary-rgba font-18"><i
                                                        class="feather icon-shopping-bag"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End col -->

                        </div>
                        <!-- Start row -->
                    </div>
                </div>
            </div>
            <!-- End On sale -->

            <!-- Start New Products -->
            <div class="col-lg-8 col-xl-12">
                <div class="card m-b-30">
                    <div class="card-header p-6">
                        <h5 class="card-title !text-[30px]"
                            style="font-weight: 600;">
                            On Sale
                        </h5>
                    </div>

                    <div class="card-body pt-0">
                        <!-- Start row -->
                        <div class="owl-carousel owl-theme" style="z-index: unset;">
                            <!-- Start col -->
                            <div class="product-bar m-b-25">
                                <div class="product-head">
                                    <a href="#"><img src="assets/images/ecommerce/product_img_01.jpg" class="img-fluid"
                                                     alt="product"></a>
                                    <p><span class="badge badge-success font-14">25% off</span></p>
                                </div>
                                <div class="product-body pt-3">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <div class="d-inline-block">
                                                <span class="text-uppercase font-12 f-w-6">Watch</span>
                                            </div>
                                            <div class="d-inline-block float-right">
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star"></i>
                                                <i class="feather icon-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <h6 class="mt-1 mb-3">Apple Watch</h6>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <div class="text-left">
                                                <h5 class="f-w-7 mb-0"><sup class="font-14">$</sup>350</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <button type="button" class="btn btn-primary-rgba font-18"><i
                                                        class="feather icon-shopping-bag"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End col -->
                            <!-- Start col -->
                            <div class="product-bar m-b-25">
                                <div class="product-head">
                                    <a href="#"><img src="assets/images/ecommerce/product_img_02.jpg" class="img-fluid"
                                                     alt="product"></a>
                                    <p><span class="badge badge-primary font-14">New</span></p>
                                </div>
                                <div class="product-body pt-3">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <div class="d-inline-block">
                                                <span class="text-uppercase font-12 f-w-6">Audio</span>
                                            </div>
                                            <div class="d-inline-block float-right">
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star"></i>
                                                <i class="feather icon-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <h6 class="mt-1 mb-3">Apple Air Pod</h6>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <div class="text-left">
                                                <h5 class="f-w-7 mb-0"><sup class="font-14">$</sup>120</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <button type="button" class="btn btn-primary-rgba font-18"><i
                                                        class="feather icon-shopping-bag"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End col -->
                            <!-- Start col -->
                            <div class="product-bar m-b-25">
                                <div class="product-head">
                                    <a href="#"><img src="assets/images/ecommerce/product_img_03.jpg" class="img-fluid"
                                                     alt="product"></a>
                                    <p><span class="badge badge-danger font-14">Price Drop</span></p>
                                </div>
                                <div class="product-body pt-3">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <div class="d-inline-block">
                                                <span class="text-uppercase font-12 f-w-6">Phone</span>
                                            </div>
                                            <div class="d-inline-block float-right">
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star"></i>
                                                <i class="feather icon-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <h6 class="mt-1 mb-3">Apple iPhone XR</h6>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <div class="text-left">
                                                <h5 class="f-w-7 mb-0"><sup class="font-14">$</sup>1110</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <button type="button" class="btn btn-primary-rgba font-18"><i
                                                        class="feather icon-shopping-bag"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End col -->
                            <!-- Start col -->
                            <div class="product-bar m-b-25">
                                <div class="product-head">
                                    <a href="#"><img src="assets/images/ecommerce/product_img_04.jpg" class="img-fluid"
                                                     alt="product"></a>
                                    <p><span class="badge badge-success font-14">Sale</span></p>
                                </div>
                                <div class="product-body pt-3">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <div class="d-inline-block">
                                                <span class="text-uppercase font-12 f-w-6">Tablet</span>
                                            </div>
                                            <div class="d-inline-block float-right">
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star"></i>
                                                <i class="feather icon-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <h6 class="mt-1 mb-3">Apple iPad Mini</h6>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <div class="text-left">
                                                <h5 class="f-w-7 mb-0"><sup class="font-14">$</sup>430</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <button type="button" class="btn btn-primary-rgba font-18"><i
                                                        class="feather icon-shopping-bag"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End col -->
                            <!-- Start col -->
                            <div class="product-bar m-b-25">
                                <div class="product-head">
                                    <a href="#"><img src="assets/images/ecommerce/product_img_05.jpg" class="img-fluid"
                                                     alt="product"></a>
                                    <p><span class="badge badge-warning font-14">Trending</span></p>
                                </div>
                                <div class="product-body pt-3">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <div class="d-inline-block">
                                                <span class="text-uppercase font-12 f-w-6">Laptop</span>
                                            </div>
                                            <div class="d-inline-block float-right">
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star"></i>
                                                <i class="feather icon-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <h6 class="mt-1 mb-3">Apple Mac Book Air</h6>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <div class="text-left">
                                                <h5 class="f-w-7 mb-0"><sup class="font-14">$</sup>1700</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <button type="button" class="btn btn-primary-rgba font-18"><i
                                                        class="feather icon-shopping-bag"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End col -->
                            <!-- Start col -->
                            <div class="product-bar m-b-25">
                                <div class="product-head">
                                    <a href="#"><img src="assets/images/ecommerce/product_img_06.jpg" class="img-fluid"
                                                     alt="product"></a>
                                    <p><span class="badge badge-info font-14">Popular</span></p>
                                </div>
                                <div class="product-body pt-3">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <div class="d-inline-block">
                                                <span class="text-uppercase font-12 f-w-6">Desktop</span>
                                            </div>
                                            <div class="d-inline-block float-right">
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star"></i>
                                                <i class="feather icon-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <h6 class="mt-1 mb-3">Apple Desktop</h6>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <div class="text-left">
                                                <h5 class="f-w-7 mb-0"><sup class="font-14">$</sup>2100</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <button type="button" class="btn btn-primary-rgba font-18"><i
                                                        class="feather icon-shopping-bag"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End col -->
                            <!-- Start col -->
                            <div class="product-bar m-b-25">
                                <div class="product-head">
                                    <a href="#"><img src="assets/images/ecommerce/product_img_06.jpg" class="img-fluid"
                                                     alt="product"></a>
                                    <p><span class="badge badge-info font-14">Popular</span></p>
                                </div>
                                <div class="product-body pt-3">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <div class="d-inline-block">
                                                <span class="text-uppercase font-12 f-w-6">Desktop</span>
                                            </div>
                                            <div class="d-inline-block float-right">
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star"></i>
                                                <i class="feather icon-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <h6 class="mt-1 mb-3">Apple Desktop</h6>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <div class="text-left">
                                                <h5 class="f-w-7 mb-0"><sup class="font-14">$</sup>2100</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <button type="button" class="btn btn-primary-rgba font-18"><i
                                                        class="feather icon-shopping-bag"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End col -->
                            <!-- Start col -->
                            <div class="product-bar m-b-25">
                                <div class="product-head">
                                    <a href="#"><img src="assets/images/ecommerce/product_img_06.jpg" class="img-fluid"
                                                     alt="product"></a>
                                    <p><span class="badge badge-info font-14">Popular</span></p>
                                </div>
                                <div class="product-body pt-3">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <div class="d-inline-block">
                                                <span class="text-uppercase font-12 f-w-6">Desktop</span>
                                            </div>
                                            <div class="d-inline-block float-right">
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star"></i>
                                                <i class="feather icon-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <h6 class="mt-1 mb-3">Apple Desktop</h6>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <div class="text-left">
                                                <h5 class="f-w-7 mb-0"><sup class="font-14">$</sup>2100</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <button type="button" class="btn btn-primary-rgba font-18"><i
                                                        class="feather icon-shopping-bag"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End col -->
                            <!-- Start col -->
                            <div class="product-bar m-b-25">
                                <div class="product-head">
                                    <a href="#"><img src="assets/images/ecommerce/product_img_06.jpg" class="img-fluid"
                                                     alt="product"></a>
                                    <p><span class="badge badge-info font-14">Popular</span></p>
                                </div>
                                <div class="product-body pt-3">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <div class="d-inline-block">
                                                <span class="text-uppercase font-12 f-w-6">Desktop</span>
                                            </div>
                                            <div class="d-inline-block float-right">
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star"></i>
                                                <i class="feather icon-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <h6 class="mt-1 mb-3">Apple Desktop</h6>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <div class="text-left">
                                                <h5 class="f-w-7 mb-0"><sup class="font-14">$</sup>2100</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <button type="button" class="btn btn-primary-rgba font-18"><i
                                                        class="feather icon-shopping-bag"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End col -->
                            <!-- Start col -->
                            <div class="product-bar m-b-25">
                                <div class="product-head">
                                    <a href="#"><img src="assets/images/ecommerce/product_img_06.jpg" class="img-fluid"
                                                     alt="product"></a>
                                    <p><span class="badge badge-info font-14">Popular</span></p>
                                </div>
                                <div class="product-body pt-3">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <div class="d-inline-block">
                                                <span class="text-uppercase font-12 f-w-6">Desktop</span>
                                            </div>
                                            <div class="d-inline-block float-right">
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star text-warning"></i>
                                                <i class="feather icon-star"></i>
                                                <i class="feather icon-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <h6 class="mt-1 mb-3">Apple Desktop</h6>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <div class="text-left">
                                                <h5 class="f-w-7 mb-0"><sup class="font-14">$</sup>2100</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <button type="button" class="btn btn-primary-rgba font-18"><i
                                                        class="feather icon-shopping-bag"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End col -->

                        </div>
                        <!-- Start row -->
                    </div>
                </div>
            </div>
            <!-- End New Products -->
        </div>
        <!-- End row -->
    </div>
    <!-- End Contentbar -->
</div>
