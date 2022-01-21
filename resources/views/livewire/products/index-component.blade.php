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

            @if($isCreateComponentOpen)
                @include('livewire.products.create-component')
            @else
                <button class="btn btn-primary my-4"
                        wire:click="create">
                    New Product
                </button>
            @endif

            {{-- Search Form --}}
            <div class="bg-gray-200 rounded-b text-teal-900 px-2 py-2 my-3">
                <form>
                    <div class="form-group mb-0">
                        <div class="input-group input-group-merge input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="padding:0;">
                                    <select class="" style="border: none;"
                                            id="exampleFormControlSelect3"
                                            wire:model="search_field">
                                        <option value="code">Product Code</option>
                                        <option value="name">Name</option>
                                        <option value="serial">Serial</option>
                                    </select>
                                </span>
                            </div>
                            <input class="form-control" placeholder="Search"
                                   type="text" wire:model="searchKeyword">
                        </div>
                    </div>
                </form>
            </div>

            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="text-center  w-20" style="padding:15px 15px">No</th>
                        <th class="text-center" style="padding:15px 15px">Name</th>
                        <th class="text-center" style="padding:15px 15px">Code</th>
                        <th class="text-center" style="padding:15px 15px">Amount</th>
                        <th class="text-center" style="padding:15px 15px">Cost</th>
                        <th class="text-center" style="padding:15px 15px">Price</th>
                        <th class="text-center" style="padding:15px 15px">Serial</th>
                        <th class="text-center" style="padding:15px 15px">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($products as $product)
                        <tr>
                            <td class="border text-center" style="padding:15px 15px">{{$product->id}}</td>

                            {{-- Name --}}
                            <td class="border text-center" style="padding:15px 15px">

                                @if(isset($is_edit['name'][$product->id]))
                                    @if($is_edit['name'][$product->id])
                                        <input type="text"
                                               class="form-control"
                                               wire:model.lazy="name.{{$product->id}}"
                                               wire:keydown.enter="updateNew('{{$product->id}}', 'name')"
                                               wire:keydown.escape="closeEdit('{{$product->id}}', 'name')">
                                    @else
                                        <div wire:click="editNew({{$product->id}}, 'name')">{{$product->name}}</div>
                                    @endif
                                @else
                                    <div wire:click="editNew({{$product->id}}, 'name')">{{$product->name}}</div>
                                @endif

                                @error("name.$product->id") <h1 class="alert-danger">{{$message}}</h1> @enderror
                            </td>

                            {{-- Code --}}
                            <td class="border text-center" style="padding:15px 15px">

                                @if(isset($is_edit['code'][$product->id]))
                                    @if($is_edit['code'][$product->id])
                                        <input type="text"
                                               class="form-control"
                                               wire:model.lazy="code.{{$product->id}}"
                                               wire:keydown.enter="updateNew('{{$product->id}}', 'code')"
                                               wire:keydown.escape="closeEdit('{{$product->id}}', 'code')">
                                    @else
                                        <div wire:click="editNew({{$product->id}}, 'code')">{{$product->code}}</div>
                                    @endif
                                @else
                                    <div wire:click="editNew({{$product->id}}, 'code')">{{$product->code}}</div>
                                @endif
                                @error("code.$product->id") <h1 class="alert-danger">{{$message}}</h1> @enderror
                            </td>

                            {{-- Amount --}}
                            <td class="border text-center" style="padding:15px 15px">
                                @if(isset($is_edit['amount'][$product->id]))
                                    @if($is_edit['amount'][$product->id])
                                        <input type="number"
                                               class="form-control"
                                               wire:model.lazy="amount.{{$product->id}}"
                                               wire:keydown.enter="updateNew('{{$product->id}}', 'amount')"
                                               wire:keydown.escape="closeEdit('{{$product->id}}', 'amount')">
                                    @else
                                        <div wire:click="editNew({{$product->id}}, 'amount')">{{$product->amount}}</div>
                                    @endif
                                @else
                                    <div wire:click="editNew({{$product->id}}, 'amount')">{{$product->amount}}</div>
                                @endif
                                @error("amount.$product->id") <h1 class="alert-danger">{{$message}}</h1> @enderror
                            </td>

                            {{-- Cost --}}
                            <td class="border text-center" style="padding:15px 15px">
                                @if(isset($is_edit['cost'][$product->id]))
                                    @if($is_edit['cost'][$product->id])
                                        <input type="number"
                                               class="form-control"
                                               wire:model.lazy="cost.{{$product->id}}"
                                               wire:keydown.enter="updateNew('{{$product->id}}', 'cost)"
                                               wire:keydown.escape="closeEdit('{{$product->id}}', 'cost)">
                                    @else
                                        <div wire:click="editNew({{$product->id}}, 'cost')">{{$product->cost}}</div>
                                    @endif
                                @else
                                    <div wire:click="editNew({{$product->id}}, 'cost')">{{$product->cost}}</div>
                                @endif
                                @error("cost.$product->id") <h1 class="alert-danger">{{$message}}</h1> @enderror
                            </td>

                            {{-- Price --}}
                            <td class="border text-center" style="padding:15px 15px">
                                @if(isset($is_edit['price'][$product->id]))
                                    @if($is_edit['price'][$product->id])
                                        <input type="number"
                                               class="form-control"
                                               wire:model.lazy="price.{{$product->id}}"
                                               wire:keydown.enter="updateNew('{{$product->id}}', 'price')"
                                               wire:keydown.escape="closeEdit('{{$product->id}}', 'price')">
                                    @else
                                        <div wire:click="editNew({{$product->id}}, 'price')">{{$product->price}}</div>
                                    @endif
                                @else
                                    <div wire:click="editNew({{$product->id}}, 'price')">{{$product->price}}</div>
                                @endif
                                @error("price.$product->id") <h1 class="alert-danger">{{$message}}</h1> @enderror
                            </td>

                            {{-- Serial --}}
                            <td class="border text-center" style="padding:15px 15px">
                                @if(isset($is_edit['serial'][$product->id]))
                                    @if($is_edit['serial'][$product->id])
                                        <input type="number"
                                               class="form-control"
                                               wire:model.lazy="serial.{{$product->id}}"
                                               wire:keydown.enter="updateNew('{{$product->id}}', 'serial)"
                                               wire:keydown.escape="closeEdit('{{$product->id}}', 'serial)">
                                    @else
                                        <div wire:click="editNew({{$product->id}}, 'serial')">{{$product->serial}}</div>
                                    @endif
                                @else
                                    <div wire:click="editNew({{$product->id}}, 'serial')">{{$product->serial}}</div>
                                @endif
                                @error("serial.$product->id") <h1 class="alert-danger">{{$message}}</h1> @enderror
                            </td>

                            {{-- Actions --}}
                            <td class="border text-center" style="padding:15px 15px">

                                @if(isset($is_view_product_actions[$product->id]))
                                    @if($is_view_product_actions[$product->id])
                                        {{-- Update --}}
                                        <button class="btn-success btn-sm"
                                                wire:click="updateNew('{{$product->id}}', '{{$edit_method_name}}')">
                                            <i class="ni ni-2x ni-active-40"></i>
                                        </button>

                                        {{-- Close --}}
                                        <button class="btn-danger btn-sm"
                                                wire:click="closeEdit('{{$product->id}}', '{{$edit_method_name}}')">
                                            <i class="ni ni-2x ni-fat-remove"></i>
                                        </button>
                                    @else
                                        {{-- View Product Details --}}
                                        <button class="btn-primary btn-sm"
                                                wire:click="viewProductDetails('{{$product->id}}')">
                                            <i class="ni ni-2x ni-bold-down"></i>
                                        </button>
                                    @endif
                                @else
                                    {{-- View Product Details --}}
                                    <button class="btn-primary btn-sm"
                                            wire:click="viewProductDetails('{{$product->id}}')">
                                        <i class="ni ni-2x ni-bold-down"></i>
                                    </button>
                                @endif

                            </td>
                        </tr>

                        @if(isset($is_view_product_details[$product->id]))
                            @if($is_view_product_details[$product->id])
                                <tr>
                                    <td colspan="7" class="border" >
                                        @include('livewire.products.details-component')
                                    </td>
                                </tr>
                            @endif
                        @endif
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
