<div>
    <div class="container mt-4 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-7">

                {{--Add New Product to the container--}}

                @include('livewire.products-container.create-component')

                {{--Container Contents--}}
                <table class="table-fixed w-full">
                    <thead>
                    <tr class="bg-gray-200">
                        <th colspan="8" class="text-center  w-20" style="padding:15px 15px">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4><span class="badge rounded-pill" style="color:#6b6a6a;background:#11cdef;">Count: {{$products_container_counter}}</span></h4>
                                </div>
                                <div class="col-lg-6">
                                    <h4><span class="badge rounded-pill bg-success">Amount: {{$products_container_total_amount}}</span></h4>
                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr class="bg-gray-200">
                        <th class="text-center  w-20" style="padding:15px 15px">No</th>
                        <th class="text-center" style="padding:15px 15px">Name</th>
                        <th class="text-center" style="padding:15px 15px">Serial</th>
                        <th class="text-center" style="padding:15px 15px">Code</th>
                        <th class="text-center" style="padding:15px 15px">Amount</th>
                        <th class="text-center" style="padding:15px 15px">Cost</th>
                        <th class="text-center" style="padding:15px 15px">Price</th>
                        <th class="text-center" style="padding:15px 15px">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($products as $id => $product)
                        <tr>
                            <td class="border text-center" style="padding:15px 15px">{{$id}}</td>

                            {{-- Name --}}
                            <td class="border text-center" style="padding:15px 15px">

                                @if(isset($is_edit['name'][$id]))
                                    @if($is_edit['name'][$id])
                                        <input type="text"
                                               class="form-control"
                                               wire:model.lazy="name.{{$id}}"
                                               wire:keydown.enter="updateNew('{{$id}}', 'name')"
                                               wire:keydown.escape="closeEdit('{{$id}}', 'name')">
                                    @else
                                        <div wire:click="editNew({{$id}}, 'name')">{{$product['name']}}</div>
                                    @endif
                                @else
                                    <div wire:click="editNew({{$id}}, 'name')">{{$product['name']}}</div>
                                @endif

                                @error("name.$id") <h1 class="alert-danger">{{$message}}</h1> @enderror
                            </td>

                            {{--Serial--}}
                            <td class="border text-center" style="padding:15px 15px">
                                @if(isset($is_edit['serial'][$id]))
                                    @if($is_edit['serial'][$id])
                                        <input type="number"
                                               class="form-control"
                                               wire:model.lazy="serial.{{$id}}"
                                               wire:keydown.enter="updateNew('{{$id}}', 'serial')"
                                               wire:keydown.escape="closeEdit('{{$id}}', 'serial')">
                                    @else
                                        <div wire:click="editNew({{$id}}, 'serial')">{{$product['serial']}}</div>
                                    @endif
                                @else
                                    <div wire:click="editNew({{$id}}, 'serial')">{{$product['serial']}}</div>
                                @endif
                                @error("serial.$id") <h1 class="alert-danger">{{$message}}</h1> @enderror
                            </td>

                            {{-- Code --}}
                            <td class="border text-center" style="padding:15px 15px">

                                @if(isset($is_edit['code'][$id]))
                                    @if($is_edit['code'][$id])
                                        <input type="text"
                                               class="form-control"
                                               wire:model.lazy="code.{{$id}}"
                                               wire:keydown.enter="updateNew('{{$id}}', 'code')"
                                               wire:keydown.escape="closeEdit('{{$id}}', 'code')">
                                    @else
                                        <div wire:click="editNew({{$id}}, 'code')">{{$product['code']}}</div>
                                    @endif
                                @else
                                    <div wire:click="editNew({{$id}}, 'code')">{{$product['code']}}</div>
                                @endif
                                @error("code.$id") <h1 class="alert-danger">{{$message}}</h1> @enderror
                            </td>

                                {{-- Amount --}}
                            <td class="border text-center" style="padding:15px 15px">
                                @if(isset($is_edit['amount'][$id]))
                                    @if($is_edit['amount'][$id])
                                        <input type="number"
                                               class="form-control"
                                               wire:model.lazy="amount.{{$id}}"
                                               wire:keydown.enter="updateNew('{{$id}}', 'amount')"
                                               wire:keydown.escape="closeEdit('{{$id}}', 'amount')">
                                    @else
                                        <div wire:click="editNew({{$id}}, 'amount')">{{$product['amount']}}</div>
                                    @endif
                                @else
                                    <div wire:click="editNew({{$id}}, 'amount')">{{$product['amount']}}</div>
                                @endif
                                @error("amount.$id") <h1 class="alert-danger">{{$message}}</h1> @enderror
                            </td>

                                {{-- Cost --}}
                            <td class="border text-center" style="padding:15px 15px">
                                @if(isset($is_edit['cost'][$id]))
                                    @if($is_edit['cost'][$id])
                                        <input type="number"
                                               class="form-control"
                                               wire:model.lazy="cost.{{$id}}"
                                               wire:keydown.enter="updateNew('{{$id}}', 'cost')"
                                               wire:keydown.escape="closeEdit('{{$id}}', 'cost')">
                                    @else
                                        <div wire:click="editNew({{$id}}, 'cost')">{{$product['cost']}}</div>
                                    @endif
                                @else
                                    <div wire:click="editNew({{$id}}, 'cost')">{{$product['cost']}}</div>
                                @endif
                                @error("cost.$id") <h1 class="alert-danger">{{$message}}</h1> @enderror
                            </td>

                                {{-- Price --}}
                            <td class="border text-center" style="padding:15px 15px">
                                @if(isset($is_edit['price'][$id]))
                                    @if($is_edit['price'][$id])
                                        <input type="number"
                                               class="form-control"
                                               wire:model.lazy="price.{{$id}}"
                                               wire:keydown.enter="updateNew('{{$id}}', 'price')"
                                               wire:keydown.escape="closeEdit('{{$id}}', 'price')">
                                    @else
                                        <div wire:click="editNew({{$id}}, 'price')">{{$product['price']}}</div>
                                    @endif
                                @else
                                    <div wire:click="editNew({{$id}}, 'price')">{{$product['price']}}</div>
                                @endif
                                @error("price.$id") <h1 class="alert-danger">{{$message}}</h1> @enderror
                            </td>

                                {{-- Actions --}}
                            <td class="border text-center" style="padding:15px 15px">

                                @if(isset($is_view_product_actions[$id]))
                                    @if($is_view_product_actions[$id])
                                        {{--Update--}}
                                        <button class="btn-success btn-sm"
                                                wire:click="updateNew('{{$id}}', '{{$edit_method_name}}')">
                                            <i class="ni ni-2x ni-active-40"></i>
                                        </button>

                                        {{--Close--}}
                                        <button class="btn-danger btn-sm"
                                                wire:click="closeEdit('{{$id}}', '{{$edit_method_name}}')">
                                            <i class="ni ni-2x ni-fat-remove"></i>
                                        </button>
                                    @else
                                        {{--View Product Details--}}
                                        <button class="btn-primary btn-sm"
                                                wire:click="viewProductDetails('{{$id}}')">
                                            <i class="ni ni-2x ni-bold-down"></i>
                                        </button>
                                    @endif
                                @else
                                    {{--View Product Details--}}
                                    <button class="btn-primary btn-sm"
                                            wire:click="viewProductDetails('{{$id}}')">
                                        <i class="ni ni-2x ni-bold-down"></i>
                                    </button>
                                @endif

                            </td>
                        </tr>

                        @if(isset($is_view_product_details[$id]))
                            @if($is_view_product_details[$id])
                                <tr>
                                    <td colspan="8" class="border">
                                        @include('livewire.products-container.details-component')
                                    </td>
                                </tr>
                            @endif
                        @endif
                    @empty

                        <tr>
                            <td colspan="8" class="border text-center" style="padding:10px">
                                <h3>You Do not Have any items yet.</h3>
                            </td>
                        </tr>
                    @endforelse

                        <tr>
                            <td colspan="8" class="border text-center" style="padding:10px">
                                <button type="button" wire:click="createProductsFromContainer"
                                        class="btn btn-info">
                                    Create
                                </button>
                                <button type="button" wire:click="emptyContainer"
                                        class="btn btn-danger">
                                    Empty
                                </button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
