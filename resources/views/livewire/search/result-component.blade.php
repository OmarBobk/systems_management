<div>
    <div class="row">
        @forelse($result as $product)
            <div class="col-4">
                    <div class="card card-stats" style="background: rgb(0 0 0 / 8%);">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                {{--Product Img--}}
                                <div class="col-auto">
                                    <img src="https://via.placeholder.com/75/09f/fff.png">
                                </div>
                                <div class="col-7">
                                    {{--Product Name--}}
                                    <h5 class="card-title text-muted mb-0">{{$product->name}}</h5>

                                    {{--Product Cost--}}
                                    <span class="d-block mb-0">Cost: {{$product->cost}} TL</span>
                                    {{--Product Price--}}
                                    <span class="d-block mb-0">Sale: {{$product->price}} TL</span>
                                    <span class="d-block mb-0">Code: {{$product->code}}</span>
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
    </div>
</div>

