<!-- Start Topbar Mobile -->
<div class="topbar-mobile">
    <div class="row align-items-center">
        <div class="col-md-12">
            {{-- Logo --}}
            <div class="mobile-logobar">
                <a href="index.html" class="mobile-logo">
                    <img src="{{asset('assets/images/logo.svg')}}" class="img-fluid" alt="logo">
                </a>
            </div>

            <div class="mobile-togglebar">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <div class="menubar">
                            <a class="menu-hamburger navbar-toggle p-0 bg-transparent"
                               href="javascript:void(0)" data-toggle="collapse"
                               data-target="#navbar-menu" aria-expanded="true">
                                <img src="{{asset('assets/images/svg-icon/collapse.svg')}}" class="img-fluid menu-hamburger-collapse" alt="collapse">
                                <img src="{{asset('assets/images/svg-icon/close.svg')}}" class="img-fluid menu-hamburger-close" alt="close">
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Topbar Mobile -->

<!-- Start Topbar -->
<div class="topbar">
    <!-- Start container-fluid -->
    <div class="container-fluid">
        <!-- Start row -->
        <div class="row align-items-center">
            <!-- Start col -->
            <div class="col-md-12 align-self-center">
                <div class="togglebar w-full">
                    <ul class="list-inline mb-0 d-flex justify-between">
                        {{-- Logo --}}
                        <li class="list-inline-item">
                            <div class="logobar">
                                <a href="index.html"
                                   class="logo logo-large">
                                    <img src="{{asset('assets/images/logo.svg')}}"
                                         class="!h-[50px]  img-fluid" alt="logo">
                                </a>
                            </div>
                        </li>

                        {{--Search Field--}}
                        <li class="list-inline-item">
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
            <!-- End col -->
        </div>
        <!-- End row -->
    </div>
    <!-- End container-fluid -->
</div>
<!-- End Topbar -->


<style>
    @media (max-width: 991px) {
        .horizontal-nav .horizontal-menu li {
            float: none;
            width: 100%;
            text-align: left !important;
        }
    }
</style>


<!-- Start Navigationbar -->
<div class="navigationbar">
    <!-- Start container-fluid -->
    <div class="container-fluid">
        <!-- Start Horizontal Nav -->
        <nav class="horizontal-nav mobile-navbar fixed-navbar">
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="horizontal-menu w-full">
                    {{--Home--}}
                    <li class="w-1/5 text-center scroll">
                        <a href="{{route('frontend.home')}}">
                            <i class="bi bi-house-fill text-[#263a5b]"></i>
                            <span>{{__('header.home')}}</span>
                        </a>
                    </li>

                    {{--Categories--}}
                    <li class="dropdown w-1/5 text-center menu-item-has-mega-menu">
                        <a href="javaScript:void(0)"
                           class="dropdown-toggle"
                           data-toggle="dropdown">
                            <i class="bi bi-tag-fill text-[#263a5b]"></i>
                            <span>{{__('header.categories')}}</span>
                        </a>

                        <div class="mega-menu dropdown-menu">
                            <ul class="mega-menu-row" role="menu">
                                <li class="mega-menu-col col-md-3">
                                    <ul class="sub-menu">
                                        <li><a href="basic-ui-kits-alerts.html">Alerts</a></li>
                                        <li><a href="basic-ui-kits-badges.html">Badges</a></li>
                                        <li><a href="basic-ui-kits-buttons.html">Buttons</a></li>
                                        <li><a href="basic-ui-kits-cards.html">Cards</a></li>
                                        <li><a href="basic-ui-kits-carousel.html">Carousel</a></li>
                                    </ul>
                                </li>
                                <li class="mega-menu-col col-md-3">
                                    <ul class="sub-menu">
                                        <li><a href="basic-ui-kits-collapse.html">Collapse</a></li>
                                        <li><a href="basic-ui-kits-dropdowns.html">Dropdowns</a></li>
                                        <li><a href="basic-ui-kits-embeds.html">Embeds</a></li>
                                        <li><a href="basic-ui-kits-grids.html">Grids</a></li>
                                        <li><a href="basic-ui-kits-images.html">Images</a></li>
                                    </ul>
                                </li>
                                <li class="mega-menu-col col-md-3">
                                    <ul class="sub-menu">
                                        <li><a href="basic-ui-kits-media.html">Media</a></li>
                                        <li><a href="basic-ui-kits-modals.html">Modals</a></li>
                                        <li><a href="basic-ui-kits-paginations.html">Paginations</a></li>
                                        <li><a href="basic-ui-kits-popovers.html">Popovers</a></li>
                                        <li><a href="basic-ui-kits-progressbars.html">Progress Bars</a></li>
                                    </ul>
                                </li>
                                <li class="mega-menu-col col-md-3">
                                    <ul class="sub-menu">
                                        <li><a href="basic-ui-kits-spinners.html">Spinners</a></li>
                                        <li><a href="basic-ui-kits-tabs.html">Tabs</a></li>
                                        <li><a href="basic-ui-kits-toasts.html">Toasts</a></li>
                                        <li><a href="basic-ui-kits-tooltips.html">Tooltips</a></li>
                                        <li><a href="basic-ui-kits-typography.html">Typography</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </li>

                    {{--Shop--}}
                    <li class="w-1/5 text-center scroll">
                        <a href="{{route('frontend.shop')}}">
                            <i class="bi bi-shop text-[#263a5b]"></i>
                            <span>{{__('header.shop')}}</span>
                        </a>
                    </li>

                    {{--Contact Us--}}
                    <li class="w-1/5 text-center scroll">
                        <a href="{{route('frontend.contactus')}}">
                            <i class="bi bi-telephone-fill text-[#263a5b]"></i>
                            <span>{{__('header.contactus')}}</span>
                        </a>
                    </li>

                    {{--FAQ--}}
                    <li class="w-1/5 text-center scroll">
                        <a href="{{route('frontend.faq')}}">
                            <i class="bi bi-question-square-fill text-[#263a5b]"></i>
                            <span>{{__('header.faq')}}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- End Horizontal Nav -->
    </div>
    <!-- End container-fluid -->
</div>
<!-- End Navigationbar -->
