<div>
    <div class="row m-[0]">
        @forelse($result as $product)
            <div class="col-12 col-sm-4 mt-[1rem]">
                    <div class="card card-stats h-full" style="background: rgb(0 0 0 / 8%);">
                        <!-- Card body -->
                        <div class="card-body flex flex-col justify-evenly">
                            <div class="row align-items-center">
                                {{--Product Img--}}
                                <div class="col-auto">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img class="w-full h-full rounded-full"
                                             src="{{$product->images()->first()?->path}}"
                                             alt="" />
                                    </div>
                                </div>
                                <div class="col-7">
                                    {{--Product Name--}}
                                    <h5 class="card-title text-muted mb-0">{{$product->name}}</h5>

                                    {{--Product Cost--}}
                                    <span class="d-block mb-0">Cost: {{number_format($product->cost/1000, 3)}} TL</span>
                                    {{--Product Price--}}
                                    <span class="d-block mb-0">Sale: {{number_format($product->price/1000, 3)}} TL</span>
                                    <span class="d-block mb-0">Code: {{$product->code}}</span>
                                    <span class="d-block mb-0">Amount: {{$product->amount}}</span>
                                    <span class="d-block mb-0">Category: {{$product->category->name}}</span>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                {{--Product Serial--}}
                                <p class="mt-3 mb-0 text-sm">
                                    <span class="text-nowrap">{{$product->serial}}</span>
                                </p>
                                <a class="btn btn-icon btn-primary btn-sm"
                                   style="line-height:2.1;" href="#"
                                   wire:click="addItemToCart('{{$product->id}}')">Add To Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
        @empty
            no
        @endforelse
        <div class="w-full mb-[1rem] px-[15px] mt-[1rem]">
            {{$result->links()}}
        </div>
    </div>
</div>

