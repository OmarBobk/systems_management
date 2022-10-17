<div>
    <div class="container mt-4 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-7">

                {{--Create New Container Form--}}

                @if($is_open_create_form)
                    @include('livewire.backend.containers-manager.create-component')
                @endif

                <div>
                    <button type="button" wire:click="openCreateForm()"
                            class="btn btn-info">
                        Create
                    </button>
                </div>
                <br>

                {{--Container Contents--}}
                <table class="table-fixed w-full">
                    <thead>
                    <tr class="bg-gray-200">
                        <th class="text-center  w-20" style="padding:15px 15px">No</th>
                        <th class="text-center" style="padding:15px 15px">Items</th>
                        <th class="text-center" style="padding:15px 15px">Cost</th>
                        <th class="text-center" style="padding:15px 15px">Bill</th>
                        <th class="text-center" style="padding:15px 15px">Is Created</th>
                        <th class="text-center" style="padding:15px 15px">Created At</th>
                        <th class="text-center" style="padding:15px 15px">Last Update</th>
                        <th class="text-center" style="padding:15px 15px">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($containers as $container)
                        <tr>
                            <td class="border text-center" style="padding:15px 15px">{{$container->id}}</td>

                            {{-- Items --}}
                            <td class="border text-center" style="padding:15px 15px">

                                {{--Number of items not amount--}}
                                {{$this->productsInContainer($container->id)['count']}}

                            </td>

                            {{--Cost--}}
                            <td class="border text-center" style="padding:15px 15px">

                                {{-- Cost Of total products in the container --}}
                                {{number_format($this->productsInContainer($container->id)['cost'] / 1000, 3)}}

                            </td>

                            {{-- Bill Information --}}
                            <td class="border text-center" style="padding:15px 15px">
                                <div>{{$container->bill->serial}} | {{$container->bill->amount}}
                                    | {{$container->bill->seller->name}}</div>
                            </td>

                            {{-- Is Created --}}
                            <td class="border text-center" style="padding:15px 15px">
                                @if($container->is_created)
                                    <h2 class="bg-success badge " style="font-size: 100%;line-height: 1.5;">
                                        Created
                                    </h2>
                                @else
                                    <div class="bg-danger">
                                        Not Yet
                                    </div>
                                @endif
                            </td>

                            {{-- Created Date --}}
                            <td class="border text-center" style="padding:15px 15px">
                                {{\Carbon\Carbon::parse($container->created_at)->format('Y-m-d G:i:a')}}
                            </td>

                            {{-- Updated Date --}}
                            <td class="border text-center" style="padding:15px 15px">
                                {{\Carbon\Carbon::parse($container->updated_at)->format('Y-m-d G:i:a')}}
                            </td>

                            {{-- Actions --}}
                            <td class="border text-center" style="padding:15px 15px">
                                <div class="row">

                                    <div class="col-6">
                                        <button class="btn-primary btn-sm"
                                                wire:click="viewContainer('{{$container->id}}')">
                                            <i class="far fa-2x fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty

                        <tr>
                            <td colspan="8" class="border text-center" style="padding:10px">
                                <h3>You Do not Have any items yet.</h3>
                            </td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
