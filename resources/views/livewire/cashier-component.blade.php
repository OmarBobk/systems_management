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
                               type="text" wire:model="searchKeyword">
{{--                        @error('cost') <span class="text-red-500">{{ $message }}</span> @enderror--}}
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
                        <th class="px-4 py-2">Price</th>
                        <th class="px-4 py-2">Cost</th>
                        <th class="px-4 py-2">Amount</th>
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
                                    <td class="border px-4 py-2">{{$product->price}}</td>
                                    <td class="border px-4 py-2">{{$product->cost}}</td>
                                    <td class="border px-4 py-2">2</td>
                                    <td class="border px-4 py-2">400</td>
                                    <td class="border px-4 py-2">380</td>
                                    <td class="border px-4 py-2">
                                        <button class="btn-danger btn-sm"
                                                wire:click="removeItemFromCart('{{$product->id}}')">
                                            <i class="ni ni-2x ni-fat-remove"></i>
                                        </button>
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

            <div style="padding-right:20px;margin-top:25px;float:right">
                <button wire:click="emptyTheCart" class="btn btn-danger btn-m">Empty</button>
                <button type="button" class="btn btn-m btn-success">Checkout</button>
            </div>

        </div>
    </div>

</div>
