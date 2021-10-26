<div>
        @forelse($results as $seller)
            <div class="row">
                <div class="col-3">
                    <div class="card card-stats" style="background: rgb(0 0 0 / 8%);">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <a href="#" wire:click="showBrandsFromSearch('{{$seller->id}}')">
                                    <div class="col">

                                        {{--Seller Name--}}
                                        <h4 class="card-title mb-0">Name: {{$seller->name}} </h4>

                                        {{-- Seller Phone --}}
                                        <span class="d-block mb-0">Phone: {{$seller->phone}}</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @if(isset($is_show_brands_from_search[$seller->id]) and $is_show_brands_from_search[$seller->id] == true)
                        <div class="col-9 overflow-auto">

                            {{--Sellers--}}
                            <div>
                                <table class="table-fixed w-full">
                                    <thead>
                                    <tr class="bg-gray-100">
                                        <th class="px-4 py-2 w-20">No</th>
                                        <th class="px-4 py-2">Name</th>
                                        <th class="px-4 py-2">Phone</th>
                                        <th class="px-4 py-2">Address</th>
                                        <th class="px-4 py-2">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                            {{--Name--}}
                                            <td class="border px-4 py-2">{{$seller->id}}</td>
                                            <td class="border px-4 py-2" wire:click="editName('{{$seller->id}}')">
                                                @if(isset($editName[$seller->id]))
                                                    @if($editName[$seller->id])
                                                        <input type="text"
                                                               class="form-control"
                                                               wire:model.lazy="name.{{$seller->id}}"
                                                               wire:keydown.enter="updateNameEnter('{{$seller->id}}')"
                                                               wire:keydown.escape="closeUpdateNameEnter('{{$seller->id}}')">
                                                    @else
                                                        {{$seller->name}}
                                                    @endif
                                                @else
                                                    {{$seller->name}}
                                                @endif
                                            </td>

                                            {{--Phone--}}
                                            <td class="border px-4 py-2" wire:click="editPhone('{{$seller->id}}')">
                                                @if(isset($editPhone[$seller->id]))
                                                    @if($editPhone[$seller->id])
                                                        <input type="text"
                                                               class="form-control"
                                                               wire:model.lazy="phone.{{$seller->id}}"
                                                               wire:keydown.enter="updatePhoneEnter('{{$seller->id}}')"
                                                               wire:keydown.escape="closeUpdatePhoneEnter('{{$seller->id}}')">
                                                    @else
                                                        {{$seller->phone}}
                                                    @endif
                                                @else
                                                    {{$seller->phone}}
                                                @endif
                                            </td>

                                            {{--Address--}}
                                            <td class="border px-4 py-2">
                                                Address
                                            </td>

                                            {{--Actions--}}
                                            <td class="border px-4 py-2">
                                                @if(isset($editName[$seller->id]) or isset($editPhone[$seller->id]))
                                                    @if($editName[$seller->id] or $editPhone[$seller->id])
                                                        <button class="btn-success btn-sm"
                                                                wire:click="@if ($editName[$seller->id]) updateNameEnter('{{$seller->id}}') @else updatePhoneEnter('{{$seller->id}}') @endif">
                                                            <i class="ni ni-2x ni-active-40"></i>
                                                        </button>

                                                        <button class="btn-danger btn-sm"
                                                                wire:click="@if ($editName[$seller->id]) closeUpdateNameEnter('{{$seller->id}}') @else closeUpdatePhoneEnter('{{$seller->id}}') @endif">
                                                            <i class="ni ni-2x ni-fat-remove"></i>
                                                        </button>
                                                    @else
                                                        <button class="btn-primary btn-sm"
                                                                wire:click="viewBrandFromSearchForm('{{$seller->id}}')">
                                                            <i class="ni ni-2x ni-bold-down"></i>
                                                        </button>
                                                    @endif
                                                @else
                                                    <button class="btn-primary btn-sm"
                                                            wire:click="viewBrandFromSearchForm('{{$seller->id}}')">
                                                        <i class="ni ni-2x ni-bold-down"></i>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>

                                        {{--Brands Table--}}
                                        @if(isset($is_view_brands_from_search_form[$seller->id]))
                                            @if($is_view_brands_from_search_form[$seller->id])
                                                <tr>
                                                    <td colspan="10" class="border text-center px-4 py-2">
                                                        <table class="table-fixed w-full">
                                                            <thead>
                                                            <tr class="bg-gray-100">
                                                                <th class="px-4 py-2 w-20">No</th>
                                                                <th class="px-4 py-2">Name</th>
                                                                <th class="px-4 py-2">Description</th>
                                                                <th class="px-4 py-2">Sellers</th>
                                                                <th class="px-4 py-2">Actions</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @forelse($seller->brands as $brand)
                                                                <tr>
                                                                    <td class="border text-center px-4 py-2">{{$brand->id}}</td>

                                                                    {{--Brand Name--}}
                                                                    <td class="border text-center px-4 py-2" wire:click="editBrandName('{{$seller->id}}', '{{$brand->id}}')">
                                                                        @if(isset($is_brand_name[$seller->id][$brand->id]))
                                                                            @if($is_brand_name[$seller->id][$brand->id])
                                                                                <input type="text"
                                                                                       class="form-control"
                                                                                       wire:model.lazy="brand_name.{{$seller->id}}.{{$brand->id}}"
                                                                                       wire:keydown.enter="updateBrandName('{{$seller->id}}', '{{$brand->id}}')"
                                                                                       wire:keydown.escape="closeBrandName('{{$seller->id}}', '{{$brand->id}}')">
                                                                            @else
                                                                                {{$brand->name}}
                                                                            @endif
                                                                        @else
                                                                            {{$brand->name}}
                                                                        @endif
                                                                    </td>

                                                                    {{--Description--}}
                                                                    <td class="border text-center px-4 py-2" wire:click="editBrandDescription('{{$seller->id}}', '{{$brand->id}}')">
                                                                        @if(isset($is_brand_description[$seller->id][$brand->id]))
                                                                            @if($is_brand_description[$seller->id][$brand->id])
                                                                                <input type="text"
                                                                                       class="form-control"
                                                                                       wire:model.lazy="brand_description.{{$seller->id}}.{{$brand->id}}"
                                                                                       wire:keydown.enter="updateBrandDescription('{{$seller->id}}', '{{$brand->id}}')"
                                                                                       wire:keydown.escape="closeBrandDescription('{{$seller->id}}', '{{$brand->id}}')">
                                                                            @else
                                                                                {{$brand->description}}
                                                                            @endif
                                                                        @else
                                                                            {{$brand->description}}
                                                                        @endif
                                                                    </td>

                                                                    <td class="border text-center px-4 py-2"></td>

                                                                    {{--Actions--}}
                                                                    <td class="border text-center px-4 py-2">
                                                                        @if(isset($is_brand_name[$seller->id][$brand->id]) or isset($is_brand_description[$seller->id][$brand->id]))
                                                                            @if($is_brand_name[$seller->id][$brand->id] or $is_brand_description[$seller->id][$brand->id])
                                                                                <button class="btn-success btn-sm"
                                                                                        wire:click="determineWhatToUpdate({{$seller->id}}, {{$brand->id}})">
                                                                                    <i class="ni ni-2x ni-active-40"></i>
                                                                                </button>

                                                                                <button class="btn-danger btn-sm"
                                                                                        wire:click="determineWhatToClose({{$seller->id}}, {{$brand->id}})">
                                                                                    <i class="ni ni-2x ni-fat-remove"></i>
                                                                                </button>
                                                                            @endif
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                No
                                                            @endforelse
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            @else
                                            @endif
                                        @else
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                @endif
            </div>
        @empty
            no
        @endforelse
</div>
