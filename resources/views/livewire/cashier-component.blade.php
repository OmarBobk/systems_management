<div>
    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

            <form>
                <div class="form-group mb-3">
                    <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-search"></i></span>
                        </div>
                        <input class="form-control" placeholder="Search"
                               type="text" wire:model="searchKeyword" >
                    </div>
                </div>
            </form>

            {{--Search Result--}}
            @if($searchKeyword != '' or $searchKeyword != null)
                @include('livewire.search.result-component', $result)
            @endif

            {{--Card--}}
            <div>
                <table class="table-fixed w-full">
                    <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No</th>
                        <th class="px-4 py-2">Img</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Serial</th>
                        <th class="px-4 py-2">Amount</th>
                        <th class="px-4 py-2">Price</th>
                        <th class="px-4 py-2">Cost</th>
                        <th class="px-4 py-2">Total Price</th>
                        <th class="px-4 py-2">Total Cost</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(isset($cart))
                            @forelse($cart->products as $product)
                                <tr>
                                    <td class="border px-4 py-2">{{$product->id}}</td>
                                    <td class="border px-4 py-2"><img src="https://via.placeholder.com/75/09f/fff.png"></td>
                                    <td class="border px-4 py-2">{{$product->name}}</td>
                                    <td class="border px-4 py-2">{{$product->serial}}</td>

                                    {{--Edit Amount--}}
                                    <td class="border px-4 py-2" wire:click="editAmount('{{$product->id}}')">
                                        @if(isset($isEditAmount[$product->id]))
                                            @if($isEditAmount[$product->id])
                                                <input type="text"
                                                       class="form-control"
                                                       wire:model.lazy="amount.{{$product->id}}" wire:keydown.enter="updateAmountAttach('{{$product->id}}')">
                                            @else
                                                {{$product->carts()->first()->pivot->amount}}
                                            @endif
                                        @else
                                            {{$product->carts()->first()->pivot->amount}}
                                        @endif
                                    </td>

                                    {{--Edit Price--}}
                                    <td class="border px-4 py-2" wire:click="editPrice('{{$product->id}}')">

                                        @if(isset($isEditPrice[$product->id]))
                                            @if($isEditPrice[$product->id])
                                                <input type="text" class="form-control"
                                                       wire:model.lazy="net_price.{{$product->id}}" wire:keydown.enter="updatePriceAttach('{{$product->id}}')">
                                            @else
                                                {{$product->carts()->first()->pivot->net_price}}
                                            @endif
                                        @else
                                            {{$product->carts()->first()->pivot->net_price}}
                                        @endif
                                    </td>
                                    <td class="border px-4 py-2">{{$product->cost}}</td>
                                    <td class="border px-4 py-2">{{$product->carts()->first()->pivot->net_price * $product->carts()->first()->pivot->amount}}</td>
                                    <td class="border px-4 py-2">{{$product->carts()->first()->pivot->amount * $product->cost}}</td>

                                    {{--Actions--}}
                                    <td class="border px-4 py-2">
                                        <div class="d-flex">
                                            @if(isset($isEditAmount[$product->id]) or isset($isEditPrice[$product->id]))
                                                @if($isEditAmount[$product->id] or $isEditPrice[$product->id])
                                                    <button class="btn-success btn-sm float-left"
                                                            wire:click="@if ($isEditAmount[$product->id]) updateAmountAttach('{{$product->id}}') @else updatePriceAttach('{{$product->id}}') @endif">
                                                        <i class="ni ni-2x ni-active-40"></i>
                                                    </button>

                                                    <button class="btn-danger btn-sm float-right"
                                                            wire:click="@if ($isEditAmount[$product->id]) closeUpdateAmountAttach('{{$product->id}}') @else closeUpdatePriceAttach('{{$product->id}}')) @endif">
                                                        <i class="ni ni-2x ni-fat-remove"></i>
                                                    </button>

                                                @else
                                                    <button class="btn-danger btn-sm float-right"
                                                            wire:click="removeItemFromCart('{{$product->id}}')">
                                                        <i class="ni ni-2x ni-fat-remove"></i>
                                                    </button>
                                                @endif
                                            @else
                                                <button class="btn-danger btn-sm float-right"
                                                        wire:click="removeItemFromCart('{{$product->id}}')">
                                                    <i class="ni ni-2x ni-fat-remove"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        @else
                            <tr>
                                <td colspan="10" class="border text-center px-4 py-2">You didn't add any items to your cart yet.</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>

            {{--Checkout--}}
            <div style="padding-right:20px;margin-top:25px;float:right">
                <button wire:click="emptyTheCart" class="btn btn-danger btn-m">Empty</button>
                <button type="button" class="btn btn-m btn-success"
                        data-toggle="modal" data-target="#checkoutModal">Checkout</button>
            </div>

            <!-- Checkout Modal -->
            <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">

                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="checkoutModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body d-flex justify-content-around">
                            <button wire:click="checkoutCash" class="btn btn-info">Cash</button>
                            <button type="button" class="btn btn-primary">Debt</button>
                        </div>

                        <div class="modal-footer">

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>

</div>
