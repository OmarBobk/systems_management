<div>
    <table class="table-fixed w-full">
        <thead>
        <tr class="bg-gray-100">
            <th class="text-center" style="padding:15px 15px">Description</th>
            <th class="text-center" style="padding:15px 15px">Seller</th>
            <th class="text-center" style="padding:15px 15px">Brand</th>
            <th class="text-center" style="padding:15px 15px">Category</th>
            <th class="text-center" style="padding:15px 15px">Date</th>
            <th class="text-center" style="padding:15px 15px">By</th>
            <th class="text-center" style="padding:15px 15px">Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr>

            {{-- Description --}}
            <td class="border text-center" style="padding:15px 15px">

                @if(isset($is_edit_details['description'][$id]))
                    @if($is_edit_details['description'][$id])
                        <textarea class="form-control"
                                  wire:model.lazy="description.{{$id}}"
                                  wire:keydown.escape="closeEdit('{{$id}}', 'description')"></textarea>
                    @else
                        <div wire:click="editDetails({{$id}}, 'description')">{{$product['description']}}</div>
                    @endif
                @else
                    <div wire:click="editDetails({{$id}}, 'description')">{{$product['description']}}</div>
                @endif

                @error("description.$id") <h1 class="alert-danger">{{$message}}</h1> @enderror
            </td>

            {{-- Seller --}}
            <td class="border text-center" style="padding:15px 15px">
                {{$container->bill->seller->name}}
            </td>



            {{-- Brand --}}
            <td class="border text-center" style="padding:15px 15px">
            @if(isset($is_edit_details['brand_id'][$id]))

                @if($is_edit_details['brand_id'][$id])
                        <select class="form-control" wire:model.lazy="brand_id.{{$id}}"
                                wire:keydown.escape="closeEdit('{{$id}}', 'brand_id')">
                            <option >...</option>
                            @forelse($container->bill->seller->brands as $brand)
                                <option value="{{$brand->id}}">
                                    {{$brand->name}}
                                </option>
                            @empty
                            @endforelse
                        </select>

                    @else
                        <div wire:click="editDetails({{$id}}, 'brand_id')">
                            {{$container->bill->seller->brands()->find($product['brand_id'])->name ?? "Null"}}
                        </div>
                    @endif
                @else
                    <div wire:click="editDetails({{$id}}, 'brand_id')">
                        {{$container->bill->seller->brands()->find($product['brand_id'])->name ?? "Null"}}
                    </div>
                @endif

                @error("brand_id.$id") <h1 class="alert-danger">{{$message}}</h1> @enderror

            </td>


            {{-- Category --}}
            <td class="border text-center" style="padding:15px 15px">
                @if(isset($is_edit_details['category_id'][$id]))
                    @if($is_edit_details['category_id'][$id])
                        <select class="form-control" wire:model.lazy="category_id.{{$id}}"
                                wire:keydown.escape="closeEdit('{{$id}}', 'category_id')">
                            <option >...</option>
                            @forelse(\App\Models\Category::all() as $category)
                                <option value="{{$category->id}}"

                                >{{$category->name}}</option>
                            @empty
                            @endforelse
                        </select>

                    @else
                        <div wire:click="editDetails({{$id}}, 'category_id')">{{\App\Models\Category::find($product['category_id'])->name}}</div>
                    @endif
                @else
                    <div wire:click="editDetails({{$id}}, 'category_id')">{{\App\Models\Category::find($product['category_id'])->name}}</div>
                @endif

                @error("category_id.$id") <h1 class="alert-danger">{{$message}}</h1> @enderror
            </td>

            {{-- Date --}}
            <td class="border text-center" style="padding:15px 15px">
                {{\Carbon\Carbon::parse($product['updated_at'])->format('Y-m-d')}}
            </td>

            {{--By User --}}
            <td class="border text-center" style="padding:15px 15px">
                {{\App\Models\User::find($product['user_id'])->name}}
            </td>

            {{--Actions--}}
            <td class="border text-center" style="padding:15px 15px">
                @if(isset($is_view_product_details_actions[$id]))
                    @if($is_view_product_details_actions[$id])
                        {{-- Update --}}
                        <button class="btn-success btn-sm"
                                wire:click="updateNew('{{$id}}', '{{$edit_method_name}}')">
                            <i class="ni ni-2x ni-active-40"></i>
                        </button>

                        {{-- Close --}}
                        <button class="btn-danger btn-sm"
                                wire:click="closeEdit('{{$id}}', '{{$edit_method_name}}')">
                            <i class="ni ni-2x ni-fat-remove"></i>
                        </button>
                    @endif
                @endif
            </td>
        </tr>
        </tbody>
    </table>
</div>
