<div>
    <div class="container-fluid mt--6">
        <div class="bg-white card overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
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
                @include('livewire.backend.productsdatabase.create-component')
            @else
                <button class="btn btn-primary my-4"
                        wire:click="create">
                    New Product
                </button>
            @endif

            <div class="row py-4">
                <div class="col-6">
                    <div class="list-group-item" style="background:#f1f1f1">
                        Products Type: {{$products_type_amount}}
                    </div>
                </div>
            </div>
            <div class="dropdown-divider"></div>

            {{-- Search Form --}}
            <div class="bg-gray-200 rounded-b text-teal-900 px-2 py-2 my-3">
                <form>
                    <div class="form-group mb-0">
                        <div class="input-group input-group-merge input-group-alternative">
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
                        <th class="text-center" style="padding:15px 15px">Serial</th>
                        <th class="text-center" style="padding:15px 15px">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($products as $product)
                        <tr>
                            <td class="border text-center" c>{{$product->id}}</td>

                            {{-- Name with Image --}}

                            <td class="border text-center" style="padding:15px 15px">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img class="w-full h-full rounded-full"
                                             src="{{asset('/assets/images/products/'.$product->serial.'.jpg')}}"
{{--                                             src="{{  \Illuminate\Support\Facades\Vite::asset('resources/images/products/'.$product->serial.'.jpg') }}"--}}
                                             alt="" />
                                    </div>
                                    <div class="ml-3">
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
                                            <div class="text-gray-900 whitespace-no-wrap"
                                                 wire:click="editNew({{$product->id}}, 'name')">
                                                {{$product->name}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
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
                                    <td colspan="5" class="border text-center py-3 px-3" >
                                        @include('livewire.backend.productsdatabase.details-component')
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
