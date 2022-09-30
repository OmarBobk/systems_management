{{--
    [
        "page_title" => "shop",
        "routes" => [
            "home" => "frontend.home",
        ]
    ]
--}}
<!-- Start Breadcrumbbar -->
<div class="breadcrumbbar ">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">{{__('breadcrumb.'.$header['page_title'])}}</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    @forelse($header['breadcrumb']['routes'] as $name => $route)
                        <li class="breadcrumb-item"><a href="{{route($route)}}">{{__('breadcrumb.'.$name)}}</a></li>
                    @empty
                    @endforelse
{{--                        <li class="breadcrumb-item active" aria-current="page">{{__('breadcrumb.'.$header['page_title'])}}</li>--}}
                </ol>
            </div>
        </div>
{{--        <div class="col-md-4 col-lg-4">--}}
{{--            <div class="widgetbar">--}}
{{--                <button class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Actions</button>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</div>
<!-- End Breadcrumbbar -->
