<div>
    <table class="table-fixed w-full">
        <thead>
        <tr class="bg-gray-100">
            <th class="text-center" style="padding:15px 15px">Description</th>
            <th class="text-center" style="padding:15px 15px">Seller</th>
            <th class="text-center" style="padding:15px 15px">Brand</th>
            <th class="text-center" style="padding:15px 15px">Bill</th>
            <th class="text-center" style="padding:15px 15px">Category</th>
            <th class="text-center" style="padding:15px 15px">Contribution</th>
            <th class="text-center" style="padding:15px 15px">Date</th>
            <th class="text-center" style="padding:15px 15px">By</th>
            <th class="text-center" style="padding:15px 15px">Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr>

            {{-- Description --}}
            <td class="border text-center" style="padding:15px 15px">

                @if(isset($is_edit_details['description'][$product->id]))
                    @if($is_edit_details['description'][$product->id])
                        <textarea class="form-control"
                                  wire:model.lazy="description.{{$product->id}}"
                                  wire:keydown.escape="closeEdit('{{$product->id}}', 'description')"></textarea>
                    @else
                        <div wire:click="editDetails({{$product->id}}, 'description')">{{$product->description}}</div>
                    @endif
                @else
                    <div wire:click="editDetails({{$product->id}}, 'description')">{{$product->description}}</div>
                @endif

                @error("description.$product->id") <h1 class="alert-danger">{{$message}}</h1> @enderror
            </td>

            {{-- Seller --}}
            <td class="border text-center" style="padding:15px 15px">
                {{$product->brand()->first()->seller->name}}

            </td>

            {{-- Brand --}}
            <td class="border text-center" style="padding:15px 15px">

                @if(isset($is_edit_details['brand_id'][$product->id]))
                    @if($is_edit_details['brand_id'][$product->id])
                        <select class="form-control" wire:model.lazy="brand_id.{{$product->id}}"
                                wire:keydown.escape="closeEdit('{{$product->id}}', 'brand_id')">
                            <option >...</option>
                            @forelse($product->brand->all() as $brand)
                                <option value="{{$brand->id}}">
                                    {{$brand->name}} From: {{$brand->seller->name}}
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

            {{-- Bill --}}
            <td class="border text-center" style="padding:15px 15px">
                @if(isset($is_edit_details['bill_id'][$product->id]))
                    @if($is_edit_details['bill_id'][$product->id])
                        <select class="form-control" wire:model.lazy="bill_id.{{$product->id}}"
                                wire:keydown.escape="closeEdit('{{$product->id}}', 'bill_id')">
                            <option >...</option>
                            @forelse($product->bill->all() as $bill)
                                <option value="{{$bill->id}}">
                                    {{$bill->serial}}: {{$bill->seller->name}}
                                    <br> {{$bill->amount}} | {{$bill->created_at->format('Y-m-d')}}
                                </option>
                            @empty
                            @endforelse
                        </select>

                    @else
                        <div wire:click="editDetails({{$product->id}}, 'bill_id')">
                            {{$product->bill->serial}}: {{$product->bill->seller->name}}
                            <br> {{$product->bill->amount}} | {{$product->bill->created_at->format('Y-m-d')}}
                        </div>
                    @endif
                @else
                    <div wire:click="editDetails({{$product->id}}, 'bill_id')">
                        {{$product->bill->serial ?? "Default"}}
                    </div>
                @endif

                @error("bill_id.$product->id") <h1 class="alert-danger">{{$message}}</h1> @enderror
            </td>

            {{-- Category --}}
            <td class="border text-center" style="padding:15px 15px">
                @if(isset($is_edit_details['category_id'][$product->id]))
                    @if($is_edit_details['category_id'][$product->id])
                        <select class="form-control" wire:model.lazy="category_id.{{$product->id}}"
                                wire:keydown.escape="closeEdit('{{$product->id}}', 'category_id')">
                            <option >...</option>
                            @forelse($product->category->all() as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @empty
                            @endforelse
                        </select>

                    @else
                        <div wire:click="editDetails({{$product->id}}, 'category_id')">{{$product->category->name}}</div>
                    @endif
                @else
                    <div wire:click="editDetails({{$product->id}}, 'category_id')">{{$product->category->name}}</div>
                @endif

                @error("category_id.$product->id") <h1 class="alert-danger">{{$message}}</h1> @enderror
            </td>

            {{-- Contributor --}}
            <td class="border text-center" style="padding:15px 15px">
                @if(isset($is_edit_details['contribution_id'][$product->id]))
                    @if($is_edit_details['contribution_id'][$product->id])
                        <select class="form-control" wire:model.lazy="contribution_id.{{$product->id}}"
                                wire:keydown.escape="closeEdit('{{$product->id}}', 'contribution_id')">
                            <option >...</option>

                            @forelse($product->contribution->whereStatus(0)->get() as $contribution)
                                <option value="{{$contribution->id}}">
                                    {{$contribution->contributor->name}}: {{$contribution->amount}}
                                    <br> {{$contribution->updated_at->format('Y-m-d')}}
                                </option>
                            @empty
                            @endforelse
                        </select>

                    @else
                        <div wire:click="editDetails({{$product->id}}, 'contribution_id')">
                            {{$product->contribution->contributor->name}}: {{$product->contribution->amount}}
                            <br> {{$product->contribution->updated_at->format('Y-m-d')}}
                        </div>
                    @endif
                @else
                    <div wire:click="editDetails({{$product->id}}, 'contribution_id')">
                        {{$product->contribution->contributor->name}}: {{$product->contribution->amount}}
                        <br> {{$product->contribution->updated_at->format('Y-m-d')}}
                    </div>
                @endif

                @error("contribution_id.$product->id") <h1 class="alert-danger">{{$message}}</h1> @enderror
            </td>

            {{-- Date --}}
            <td class="border text-center" style="padding:15px 15px">
{{--                {{$product->created_at}}--}}
                {{\Carbon\Carbon::parse($product->created_at)->format('Y-m-d')}}
            </td>

            {{-- By User --}}
            <td class="border text-center" style="padding:15px 15px">
                {{$product->user->name}}
            </td>

            {{--Actions--}}
            <td class="border text-center" style="padding:15px 15px">
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
