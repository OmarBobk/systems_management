<div>
    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if(session()->has('message'))
                <div class="bg-teal-100  border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                     role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm alert alert-{{session('alert')}}">{{session('message')}}</p>
                        </div>
                    </div>
                </div>
            @endif
            <button class="btn btn-primary my-4"
                    wire:click="create">
                New Product
            </button>

            @if($isCreateComponentOpen)
                @include('livewire.products.create-component')
            @endif

            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="text-center  w-20" style="padding:15px 15px">No</th>
                        <th class="text-center" style="padding:15px 15px">Name</th>
                        <th class="text-center" style="padding:15px 15px">Code</th>
                        <th class="text-center" style="padding:15px 15px">Amount</th>
                        <th class="text-center" style="padding:15px 15px">Serial</th>
                        <th class="text-center" style="padding:15px 15px">Price</th>
                        <th class="text-center" style="padding:15px 15px">Cost</th>
                        <th class="text-center" style="padding:15px 15px">Category</th>
                        <th class="text-center" style="padding:15px 15px">Seller</th>
                        <th class="text-center" style="padding:15px 15px">Brand</th>
                        <th class="text-center" style="padding:15px 15px">Contributor</th>
                        <th class="text-center" style="padding:15px 15px">Contribution</th>
                        <th class="text-center" style="padding:15px 15px">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($products as $product)
                        <tr>
                            <td class="border text-center" style="padding:15px 15px">{{$product->id}}</td>
                            <td class="border text-center" style="padding:15px 15px">{{$product->name}}</td>
                            <td class="border text-center" style="padding:15px 15px">{{$product->code}}</td>
                            <td class="border text-center" style="padding:15px 15px">{{$product->amount}}</td>
                            <td class="border text-center" style="padding:15px 15px">{{$product->serial}}</td>
                            <td class="border text-center" style="padding:15px 15px">{{$product->price}}</td>
                            <td class="border text-center" style="padding:15px 15px">{{$product->cost}}</td>
                            <td class="border text-center" style="padding:15px 15px">{{$product->category->name}}</td>
                            <td class="border text-center" style="padding:15px 15px">{{$product->brand()->first()->seller->name}}</td>
                            <td class="border text-center" style="padding:15px 15px">{{$product->brand->name}}</td>
                            <td class="border text-center" style="padding:15px 15px">{{$product->contribution()->first()->contributor->name}}</td>
                            <td class="border text-center" style="padding:15px 15px">{{$product->contribution->amount}}</td>
                            <td class="border text-center" style="padding:15px 15px">
                                <button class="btn btn-primary my-1"
                                        wire:click="edit('{{$product->id}}')">Edit</button>
                                <button class="btn btn-danger my-1"
                                        wire:click="delete('{{$product->id}}')">Delete</button>
                            </td>
                        </tr>
                    @empty
                    @endforelse

                </tbody>
            </table>
                <div>
                    {{$products->links()}}
                </div>

        </div>
    </div>
</div>
