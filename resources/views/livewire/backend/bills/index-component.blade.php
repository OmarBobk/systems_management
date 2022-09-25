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
                New Bill
            </button>

            @if($isCreateComponentOpen)
                @include('livewire.bills.create-component')
            @endif

            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="text-center  w-20" style="padding:15px 15px">No</th>
                        <th class="text-center" style="padding:15px 15px">Type</th>
                        <th class="text-center" style="padding:15px 15px">Amount</th>
                        <th class="text-center" style="padding:15px 15px">Description</th>
                        <th class="text-center" style="padding:15px 15px">Quantity</th>
                        <th class="text-center" style="padding:15px 15px">Serial</th>
                        <th class="text-center" style="padding:15px 15px">Seller</th>
                        <th class="text-center" style="padding:15px 15px">Contribution</th>
                        <th class="text-center" style="padding:15px 15px">Date</th>
                        <th class="text-center" style="padding:15px 15px">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($bills as $bill)
                        <tr>
                            <td class="border text-center" style="padding:15px 15px">{{$bill->id}}</td>

                            {{-- Type --}}
                            <td class="border text-center" style="padding:15px 15px">

                                @if(isset($is_edit['type'][$bill->id]))
                                    @if($is_edit['type'][$bill->id])
                                        <select class="form-control" wire:model="type.{{$bill->id}}"
                                                wire:keydown.escape="closeEdit('{{$bill->id}}', 'type')">
                                            <option >...</option>
                                            <option value="goods">Goods</option>
                                        </select>
                                    @else
                                        <div wire:click="editNew({{$bill->id}}, 'type')">{{$bill->type}}</div>
                                    @endif
                                @else
                                    <div wire:click="editNew({{$bill->id}}, 'type')">{{$bill->type}}</div>
                                @endif

                                @error("type.$bill->id") <h1 class="alert-danger">{{$message}}</h1> @enderror
                            </td>

                            {{-- Amount --}}
                            <td class="border text-center" style="padding:15px 15px">
                                @if(isset($is_edit['amount'][$bill->id]))
                                    @if($is_edit['amount'][$bill->id])
                                        <input type="number"
                                               class="form-control"
                                               wire:model="amount.{{$bill->id}}"
                                               wire:keydown.enter="updateNew('{{$bill->id}}', 'amount')"
                                               wire:keydown.escape="closeEdit('{{$bill->id}}', 'amount')">
                                    @else
                                        <div wire:click="editNew({{$bill->id}}, 'amount')">{{number_format($bill->amount/1000, 3)}}</div>
                                    @endif
                                @else
                                    <div wire:click="editNew({{$bill->id}}, 'amount')">{{number_format($bill->amount/1000, 3)}}</div>
                                @endif
                                @error("amount.$bill->id") <h1 class="alert-danger">{{$message}}</h1> @enderror
                            </td>

                            {{-- Description --}}
                            <td class="border text-center" style="padding:15px 15px">
                                @if(isset($is_edit['description'][$bill->id]))
                                    @if($is_edit['description'][$bill->id])
                                        <textarea class="form-control"
                                                  wire:model="description.{{$bill->id}}"
                                                  wire:keydown.escape="closeEdit('{{$bill->id}}', 'description')"></textarea>
                                    @else
                                        <div wire:click="editNew({{$bill->id}}, 'description')">{{$bill->description}}</div>
                                    @endif
                                @else
                                    <div wire:click="editNew({{$bill->id}}, 'description')">{{$bill->description}}</div>
                                @endif
                                @error("description.$bill->id") <h1 class="alert-danger">{{$message}}</h1> @enderror
                            </td>

                            {{-- Quantity --}}
                            <td class="border text-center" style="padding:15px 15px">
                                @if(isset($is_edit['quantity'][$bill->id]))
                                    @if($is_edit['quantity'][$bill->id])
                                        <input type="number"
                                               class="form-control"
                                               wire:model="quantity.{{$bill->id}}"
                                               wire:keydown.enter="updateNew('{{$bill->id}}', 'quantity')"
                                               wire:keydown.escape="closeEdit('{{$bill->id}}', 'quantity')">
                                    @else
                                        <div wire:click="editNew({{$bill->id}}, 'quantity')">{{$bill->quantity}}</div>
                                    @endif
                                @else
                                    <div wire:click="editNew({{$bill->id}}, 'quantity')">{{$bill->quantity}}</div>
                                @endif
                                @error("quantity.$bill->id") <h1 class="alert-danger">{{$message}}</h1> @enderror
                            </td>

                            {{-- Serial --}}
                            <td class="border text-center" style="padding:15px 15px">
                                @if(isset($is_edit['serial'][$bill->id]))
                                    @if($is_edit['serial'][$bill->id])
                                        <input type="number"
                                               class="form-control"
                                               wire:model="serial.{{$bill->id}}"
                                               wire:keydown.enter="updateNew('{{$bill->id}}', 'serial)"
                                               wire:keydown.escape="closeEdit('{{$bill->id}}', 'serial)">
                                    @else
                                        <div wire:click="editNew({{$bill->id}}, 'serial')">{{$bill->serial}}</div>
                                    @endif
                                @else
                                    <div wire:click="editNew({{$bill->id}}, 'serial')">{{$bill->serial}}</div>
                                @endif
                                @error("serial.$bill->id") <h1 class="alert-danger">{{$message}}</h1> @enderror
                            </td>

                            {{-- Seller --}}
                            <td class="border text-center" style="padding:15px 15px">
                                @if(isset($is_edit['seller_id'][$bill->id]))
                                    @if($is_edit['seller_id'][$bill->id])
                                        <select class="form-control" wire:model="seller_id.{{$bill->id}}"
                                                wire:keydown.escape="closeEdit('{{$bill->id}}', 'seller_id')">
                                            <option >...</option>
                                            @forelse($bill->seller->all() as $seller)
                                                <option value="{{$seller->id}}">{{$seller->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>

                                    @else
                                        <div wire:click="editNew({{$bill->id}}, 'seller_id')">{{$bill->seller->name}}</div>
                                    @endif
                                @else
                                    <div wire:click="editNew({{$bill->id}}, 'seller_id')">{{$bill->seller->name}}</div>
                                @endif

                                @error("seller_id.$bill->id") <h1 class="alert-danger">{{$message}}</h1> @enderror
                            </td>

                            {{-- Contribution --}}
                            <td class="border text-center" style="padding:15px 15px">
                                @if(isset($is_edit['contribution_id'][$bill->id]))
                                    @if($is_edit['contribution_id'][$bill->id])
                                        <select class="form-control" wire:model="contribution_id.{{$bill->id}}"
                                                wire:keydown.escape="closeEdit('{{$bill->id}}', 'contribution_id')">
                                            <option >...</option>
                                            @forelse($bill->contribution->whereStatus(0)->get() as $contribution)
                                                <option value="{{$contribution->id}}">
                                                    {{$contribution->contributor->name}}: {{$contribution->amount}}
                                                    <br> {{$contribution->updated_at->format('Y-m-d')}}
                                                </option>
                                            @empty
                                            @endforelse
                                        </select>

                                    @else
                                        <div wire:click="editNew({{$bill->id}}, 'contribution_id')">
                                            {{$bill->contribution->contributor->name}}: {{$bill->contribution->amount}}
                                            <br> {{$bill->contribution->updated_at->format('Y-m-d')}}
                                        </div>
                                    @endif
                                @else
                                    <div wire:click="editNew({{$bill->id}}, 'contribution_id')">
                                        {{$bill->contribution->contributor->name}}: {{$bill->contribution->amount}}
                                        <br> {{$bill->contribution->updated_at->format('Y-m-d')}}
                                    </div>
                                @endif

                                @error("contribution_id.$bill->id") <h1 class="alert-danger">{{$message}}</h1> @enderror
                            </td>

                            {{-- Date --}}
                            <td class="border text-center" style="padding:15px 15px">
                                {{$bill->created_at->format('Y-m-d')}}
                            </td>

                            {{-- Actions --}}
                            <td class="border text-center" style="padding:15px 15px">

                                @if(isset($is_view_bill_actions[$bill->id]))
                                    @if($is_view_bill_actions[$bill->id])
                                        {{-- Update --}}
                                        <button class="btn-success btn-sm"
                                                wire:click="updateNew('{{$bill->id}}', '{{$edit_method_name}}')">
                                            <i class="ni ni-2x ni-active-40"></i>
                                        </button>

                                        {{-- Close --}}
                                        <button class="btn-danger btn-sm"
                                                wire:click="closeEdit('{{$bill->id}}', '{{$edit_method_name}}')">
                                            <i class="ni ni-2x ni-fat-remove"></i>
                                        </button>
                                    @else
                                        {{-- Delete --}}
                                        <button class="btn-danger btn-sm"
                                                wire:click="delete('{{$bill->id}}')">
                                            <i class="ni ni-2x ni-fat-remove"></i>
                                        </button>
                                    @endif
                                @else
                                    {{-- Delete --}}
                                    <button class="btn-danger btn-sm"
                                            wire:click="delete('{{$bill->id}}')">
                                        <i class="ni ni-2x ni-fat-remove"></i>
                                    </button>
                                @endif

                            </td>
                        </tr>
                    @empty
                    @endforelse

                </tbody>
            </table>
                <div>
{{--                    {{$bills->links()}}--}}
                </div>

        </div>
    </div>
</div>
