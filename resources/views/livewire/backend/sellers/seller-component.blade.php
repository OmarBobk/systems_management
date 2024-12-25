<div>
    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            <form>
                <div class="form-group mb-3">
                    <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-search"></i></span>
                        </div>
                        <input class="form-control" placeholder="Search By Address Or Name"
                               type="text" wire:model.debounce.500ms="searchKeyword">
                    </div>
                </div>
            </form>

            {{--Search Result--}}
            @if($searchKeyword != '' or $searchKeyword != null)
                @include('livewire.backend.sellers.searchResult-component')
            @endif

            {{-- New Seller Form --}}
            @if(isset($is_create_new_seller) and $is_create_new_seller)
                @include('livewire.backend.sellers.create-new-seller-component')
            @endif

            {{--Sellers--}}
            <div>
                <button class="btn btn-primary" wire:click="addNewSeller">New Seller</button>
                <table class="w-full mt-4">
                    <thead>
                    <tr class="bg-gray-100 text-center">
                        <th class="px-4 py-2 w-20">No</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Phone</th>
                        <th class="px-4 py-2">Address</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($sellers))
                        @forelse($sellers as $seller)
                            <tr>
                                {{--Seller ID--}}
                                <td class="border px-4 py-2 text-center">{{$seller->id}}</td>

                                {{--Seller Name--}}
                                <td class="border px-4 py-2 text-center" wire:click="editName('{{$seller->id}}')">
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

                                {{--Seller Phone--}}
                                <td class="border px-4 py-2 text-center" wire:click="editPhone('{{$seller->id}}')">
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

                                {{--Seller Address--}}
                                <td class="border px-4 py-2 text-justify" wire:click="editAddress('{{$seller->id}}')">
                                    @if(isset($editAddress[$seller->id]))
                                        @if($editAddress[$seller->id])
                                            <input type="text"
                                                   class="form-control"
                                                   wire:model.lazy="address.{{$seller->id}}"
                                                   wire:keydown.enter="updateAddressEnter('{{$seller->id}}')"
                                                   wire:keydown.escape="closeUpdateAddressEnter('{{$seller->id}}')">
                                        @else
                                            {{$seller->address}}
                                        @endif
                                    @else
                                        {{$seller->address}}
                                    @endif
                                </td>

                                {{--Actions--}}
                                <td class="border px-4 py-2 justify-center">
                                    @if(isset($editName[$seller->id]) or isset($editPhone[$seller->id]) or isset($editAddress[$seller->id]))
                                        @if($editName[$seller->id] or $editPhone[$seller->id] or $editAddress[$seller->id])
                                            {{--Update Button--}}
                                            <button class="btn-success btn-sm"
                                                    wire:click="@if ($editName[$seller->id]) updateNameEnter('{{$seller->id}}') @elseif ($editAddress[$seller->id]) updateAddressEnter('{{$seller->id}}') @else updatePhoneEnter('{{$seller->id}}') @endif">
                                                <i class="ni ni-2x ni-active-40"></i>
                                            </button>

                                            {{--Close Updating Button--}}
                                            <button class="btn-danger btn-sm"
                                                    wire:click="@if ($editName[$seller->id]) closeUpdateNameEnter('{{$seller->id}}') @elseif ($editAddress[$seller->id]) closeUpdateAddressEnter('{{$seller->id}}') @else closeUpdatePhoneEnter('{{$seller->id}}') @endif">
                                                <i class="ni ni-2x ni-fat-remove"></i>
                                            </button>
                                        @else
                                            {{--View Brands Button--}}
                                            <button class="btn-primary btn-sm"
                                                    wire:click="viewBrands('{{$seller->id}}')">
                                                <i class="ni ni-2x ni-bold-down"></i>
                                            </button>
                                        @endif
                                    @else
                                        {{--View Brands Button--}}
                                        <button class="btn-primary btn-sm"
                                                wire:click="viewBrands('{{$seller->id}}')">
                                            <i class="ni ni-2x ni-bold-down"></i>
                                        </button>
                                    @endif

                                </td>
                            </tr>

                            {{--Brands Table--}}
                            @if(isset($is_view_brands[$seller->id]))
                                @if($is_view_brands[$seller->id])
                                    <tr>
                                        <td colspan="10" class="border text-center px-4 py-2">
                                            <table class="w-full">
                                                <thead>
                                                    <tr class="bg-gray-100">
                                                        <th class="px-4 py-2 w-20">No</th>
                                                        <th class="px-4 py-2">Name</th>
                                                        <th class="px-4 py-2">Description</th>
                                                        <th class="px-4 py-2">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($seller->brands as $brand)
                                                        <tr>
                                                            <td class="border text-center px-4 py-2">{{$loop->index + 1}}</td>

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
                                                            <td class="border text-justify px-4 py-2" wire:click="editBrandDescription('{{$seller->id}}', '{{$brand->id}}')">
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
                                                        {{--End Brand--}}

                                                    @empty
                                                        <tr class="bg-gray-100">
                                                            <td colspan="10" class="border text-center px-4 py-2">You don't have any brands yet!!.</td>
                                                        </tr>
                                                    @endforelse
                                                    {{--New Seller Form--}}
                                                    <tr>
                                                        <td colspan="10">
                                                            @if(isset($is_create_new_brand) and $is_create_new_brand)
                                                                @include('livewire.backend.sellers.create-new-brand-component')
                                                            @endif
                                                        </td>
                                                    </tr>

                                                    {{--Create New Brand--}}
                                                    <tr>
                                                        <td class="border text-center px-4 py-2">
                                                            <button class="btn-primary btn-sm float-right"
                                                                    wire:click="createNewBrand('{{$seller->id}}')">
                                                                <i class="fa fa-plus fa-2x"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                @else
                                @endif
                            @else
                            @endif

                        @empty
                        @endforelse
                    @else
                        <tr>
                            <td colspan="10" class="border text-center px-4 py-2">You don't have any sellers yet!!.</td>
                        </tr>
                    @endif

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
