<div>
    <table class="table-fixed w-full">
        <thead>
        <tr class="bg-gray-100">
            <th class="text-center" style="padding:10px 5px">Description</th>
            <th class="text-center" style="padding:10px 5px">Brand</th>
            <th class="text-center" style="padding:10px 5px">Category</th>
            <th class="text-center" style="padding:10px 5px">Date</th>
            <th class="text-center" style="padding:10px 5px">Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr>

            {{-- Description --}}
            <td class="border text-center" style="padding:10px 5px">

                @if(isset($is_edit_details['description'][$product->id]))
                    @if($is_edit_details['description'][$product->id])
                        <textarea class="form-control"
                                  wire:model.lazy="description.{{$product->id}}"
                                  wire:keydown.escape="closeEdit('{{$product->id}}', 'description')"></textarea>
                    @else
                        <div wire:click="editDetails({{$product->id}}, 'description')">
                            <ul class="list-group">
                                @forelse($product['description'] as $k => $v)
                                    <li class="list-group-item !py-[3px]">{{$k . '- '. $v}}</li>
                                @empty
                                @endforelse
                            </ul>
                        </div>
                    @endif
                @else
                    <div wire:click="editDetails({{$product->id}}, 'description')">
                        <ul class="list-group">
                            @forelse($product['description'] as $k => $v)
                                <li class="list-group-item !py-[3px]">{{$k . '- '. $v}}</li>
                            @empty
                            @endforelse
                        </ul>
                    </div>
                @endif

                @error("description.$product->id") <h1 class="alert-danger">{{$message}}</h1> @enderror
            </td>

            {{-- Brand --}}
            <td class="border text-center" style="padding:10px 5px">

                @if(isset($is_edit_details['brand_id'][$product->id]))
                    @if($is_edit_details['brand_id'][$product->id])
                        <select class="form-control" wire:model.lazy="brand_id.{{$product->id}}"
                                wire:keydown.escape="closeEdit('{{$product->id}}', 'brand_id')">
                            <option>...</option>
                            @forelse($brands as $brand)
                                <option value="{{$brand->id}}">
                                    {{$brand->name}}
                                </option>
                            @empty
                            @endforelse
                        </select>

                    @else
                        <div wire:click="editDetails({{$product->id}}, 'brand_id')">
                            {{$product->brand->name}}
                        </div>
                    @endif
                @else
                    <div wire:click="editDetails({{$product->id}}, 'brand_id')">
                        {{$product->brand->name}}
                    </div>
                @endif

                @error("brand_id.$product->id") <h1 class="alert-danger">{{$message}}</h1> @enderror

            </td>
            {{-- Category --}}
            <td class="border text-center" style="padding:10px 5px">
                @if(isset($is_edit_details['category_id'][$product->id]))
                    @if($is_edit_details['category_id'][$product->id])
                        <select class="form-control" wire:model.lazy="category_id.{{$product->id}}"
                                wire:keydown.escape="closeEdit('{{$product->id}}', 'category_id')">
                            <option>...</option>
                            @forelse($product->category->all() as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @empty
                            @endforelse
                        </select>

                    @else
                        <div
                            wire:click="editDetails({{$product->id}}, 'category_id')">{{$product->category->name}}</div>
                    @endif
                @else
                    <div wire:click="editDetails({{$product->id}}, 'category_id')">{{$product->category->name}}</div>
                @endif

                @error("category_id.$product->id") <h1 class="alert-danger">{{$message}}</h1> @enderror
            </td>

            {{-- Date --}}
            <td class="border text-center" style="padding:10px 5px">
                {{--                {{$product->created_at}}--}}
                {{\Carbon\Carbon::parse($product->created_at)->format('Y-m-d')}}
            </td>
            {{--Actions--}}
            <td class="border text-center" style="padding:10px 5px">
                @if(isset($is_view_product_details_actions[$product->id]))
                    @if($is_view_product_details_actions[$product->id])
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
                    @endif
                @endif
            </td>
        </tr>
        </tbody>
    </table>
</div>
