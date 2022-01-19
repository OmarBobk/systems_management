<div>
    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

            <div class="bg-teal-100  border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                 role="alert">
                <div class="flex">
                    <div>
                        @if(session()->has('message'))
                            <p class="text-sm alert alert-{{session('alert')}}">{{session('message')}}</p>
                        @endif
                        @if(session()->has('sales_message'))
                            <p class="text-sm alert alert-{{session('sales_alert')}}">{{session('sales_message')}}</p>
                        @endif
                        @if(session()->has('debts_message'))
                            <p class="text-sm alert alert-{{session('debts_alert')}}">{{session('debts_message')}}</p>
                        @endif
                    </div>
                </div>
            </div>

            <form>
                <div class="form-group mb-3">
                    <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="padding:0;">
                                <select class="" style="border: none;" id="exampleFormControlSelect3"
                                        wire:model="search_field">
                                    <option value="name">Name</option>
                                    <option value="serial">Serial</option>
                                    <option value="code">Product Code</option>
                                </select>
                            </span>
                        </div>
                        <input class="form-control" placeholder="Search"
                               type="text" wire:model="searchKeyword">
                    </div>
                </div>
            </form>

            {{--Search Result--}}
            @if($searchKeyword != '' or $searchKeyword != null)
                @include('livewire.search.result-component', $result)
            @endif

            {{--Card--}}
            <div>
                <table class="table-fixed w-full">
                    <thead>
                    <tr class="bg-gray-100">
                        <th class="text-center py-2 w-20">No</th>
                        <th class="text-center py-2">Img</th>
                        <th class="text-center py-2">Description</th>
                        <th class="text-center py-2">Name</th>
                        <th class="text-center py-2">Serial</th>
                        <th class="text-center py-2">Code</th>
                        <th class="text-center py-2">Amount</th>
                        <th class="text-center py-2">Price</th>
                        <th class="text-center py-2">Cost</th>
                        <th class="text-center py-2">Total Price</th>
                        <th class="text-center py-2">Total Profits</th>
                        <th class="text-center py-2">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($cart))
                        @forelse($cart->products as $product)
                            <tr>
                                <td class="border text-center py-2">{{$product->id}}</td>
                                <td class="border text-center py-2"><img src="https://via.placeholder.com/75/09f/fff.png"></td>
                                {{-- Description --}}
                                <td class="border text-center py-2" style="padding:15px 15px">

                                    @if(isset($is_edit['description'][$product->id."-".$product->pivot->id]))
                                        @if($is_edit['description'][$product->id."-".$product->pivot->id])
                                            {{--                                            {{dd($amount)}}--}}
                                            <textarea
                                                   class="form-control"
                                                   wire:model.lazy="description.{{$product->id}}-{{$product->pivot->id}}"
                                                   wire:keydown.escape="closeEdit('{{$product->id}}', '{{$product->pivot->id}}', 'description')"></textarea>
                                        @else
                                            <div
                                                wire:click="editNew({{$product->id}}, '{{$product->pivot->id}}', 'description')">{{$product->pivot->description}}</div>
                                        @endif
                                    @else

                                        <div
                                            wire:click="editNew({{$product->id}}, '{{$product->pivot->id}}', 'description')">{{$product->pivot->description}}</div>
                                    @endif

                                    @error("description.$product->id") <h1 class="alert-danger">{{$message}}</h1> @enderror
                                </td>
                                <td class="border text-center py-2">{{$product->name}}</td>
                                <td class="border text-center py-2">{{$product->serial}}</td>
                                <td class="border text-center py-2">{{$product->code}}</td>

                                {{-- Amount --}}
                                <td class="border text-center py-2" style="padding:15px 15px">

                                    @if(isset($is_edit['amount'][$product->id."-".$product->pivot->id]))
                                        @if($is_edit['amount'][$product->id."-".$product->pivot->id])
                                            {{--                                            {{dd($amount)}}--}}
                                            <input type="number"
                                                   class="form-control"
                                                   wire:model.lazy="amount.{{$product->id}}-{{$product->pivot->id}}"
                                                   wire:keydown.enter="updateNew('{{$product->id}}', '{{$product->pivot->id}}', 'amount')"
                                                   wire:keydown.escape="closeEdit('{{$product->id}}', '{{$product->pivot->id}}', 'amount')">
                                        @else
                                            <div
                                                wire:click="editNew({{$product->id}}, '{{$product->pivot->id}}', 'amount')">{{$product->pivot->amount}}</div>
                                        @endif
                                    @else
                                        <div
                                            wire:click="editNew({{$product->id}}, '{{$product->pivot->id}}', 'amount')">{{$product->pivot->amount}}</div>
                                    @endif

                                    @error("amount.$product->id") <h1 class="alert-danger">{{$message}}</h1> @enderror
                                </td>

                                {{-- Price --}}
                                <td class="border text-center py-2" style="padding:15px 15px">

                                    @if(isset($is_edit['net_price'][$product->id."-".$product->pivot->id]))
                                        @if($is_edit['net_price'][$product->id."-".$product->pivot->id])
                                            {{--                                            {{dd($price)}}--}}
                                            <input type="number"
                                                   class="form-control"
                                                   wire:model.lazy="net_price.{{$product->id}}-{{$product->pivot->id}}"
                                                   wire:keydown.enter="updateNew('{{$product->id}}', '{{$product->pivot->id}}', 'net_price')"
                                                   wire:keydown.escape="closeEdit('{{$product->id}}', '{{$product->pivot->id}}', 'net_price')">
                                        @else
                                            <div
                                                wire:click="editNew({{$product->id}}, '{{$product->pivot->id}}', 'net_price')">{{$product->pivot->net_price}}</div>
                                        @endif
                                    @else
                                        <div
                                            wire:click="editNew({{$product->id}}, '{{$product->pivot->id}}', 'net_price')">{{$product->pivot->net_price}}</div>
                                    @endif

                                    @error("net_price.$product->id") <h1 class="alert-danger">{{$message}}</h1> @enderror
                                </td>

                                <td class="border text-center py-2">
                                    {{-- Product That you can edit the cost --}}
                                    @if($product->id === 1)
                                        @if(isset($is_edit['net_cost'][$product->id."-".$product->pivot->id]))
                                            @if($is_edit['net_cost'][$product->id."-".$product->pivot->id])
                                                <input type="number"
                                                       class="form-control"
                                                       wire:model.lazy="net_cost.{{$product->id}}-{{$product->pivot->id}}"
                                                       wire:keydown.enter="updateNew('{{$product->id}}', '{{$product->pivot->id}}', 'net_cost')"
                                                       wire:keydown.escape="closeEdit('{{$product->id}}', '{{$product->pivot->id}}', 'net_cost')">
                                            @else
                                                <div
                                                    wire:click="editNew({{$product->id}}, '{{$product->pivot->id}}', 'net_cost')">{{$product->pivot->net_cost}}</div>
                                            @endif
                                        @else
                                            <div
                                                wire:click="editNew({{$product->id}}, '{{$product->pivot->id}}', 'net_cost')">{{$product->pivot->net_cost}}</div>
                                        @endif

                                        @error("net_cost.$product->id") <h1 class="alert-danger">{{$message}}</h1> @enderror
                                    @else
                                        {{$product->pivot->net_cost}}
                                    @endif
                                </td>
                                <td class="border text-center py-2">{{$product->pivot->net_price * $product->pivot->amount}}</td>
                                <td class="border text-center py-2">{{$product->pivot->net_price - $product->pivot->net_cost}}</td>

                                {{--Actions--}}
                                <td class="border text-center px-3 py-2">
                                    <div class="d-flex">
                                        @if(isset($is_view_product_actions[$product->id."-".$product->pivot->id]))
                                            @if($is_view_product_actions[$product->id."-".$product->pivot->id])
                                                {{-- Update --}}
                                                <button class="btn-success btn-sm"
                                                        wire:click="updateNew('{{$product->id}}', '{{$product->pivot->id}}', '{{$edit_method_name}}')">
                                                    <i class="ni ni-2x ni-active-40"></i>
                                                </button>

                                                {{-- Close --}}
                                                <button class="btn-danger btn-sm"
                                                        wire:click="closeEdit('{{$product->id}}', '{{$product->pivot->id}}', '{{$edit_method_name}}')">
                                                    <i class="ni ni-2x ni-fat-remove"></i>
                                                </button>
                                            @else
                                                <button class="btn-danger btn-sm float-right"
                                                        wire:click="removeItemFromCart('{{$product->id}}', '{{$product->pivot->id}}')">
                                                    <i class="ni ni-2x ni-fat-remove"></i>
                                                </button>
                                            @endif
                                        @else
                                            <button class="btn-danger btn-sm float-right"
                                                    wire:click="removeItemFromCart('{{$product->id}}', '{{$product->pivot->id}}')">
                                                <i class="ni ni-2x ni-fat-remove"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">
                                    <h1>Your Card is Empty</h1>
                                </td>
                            </tr>
                        @endforelse
                    @else
                        <tr>
                            <td colspan="10" class="border text-center px-4 py-2">You didn't add any items to your cart
                                yet.
                            </td>
                        </tr>
                    @endif

                    </tbody>
                </table>
            </div>

            {{--Checkout--}}
            <div class="flex-column d-flex align-items-center" style="padding-right:20px;margin-top:25px;">
                <div>
                    <button wire:click="emptyTheCart" class="btn btn-danger btn-m">Empty</button>
                    <button type="button" class="btn btn-m btn-success"
                            wire:click="checkout"
                    >Checkout
                    </button>
                </div>

                {{--Cash Or Debt--}}
                @if(isset($is_checkout) and $is_checkout)
                    <div style="margin-top:10px;">
                        <h1>Is it Cash Or Debt?</h1>
                        <button wire:click="checkoutCash" class="btn btn-info">Cash</button>
                        <button wire:click="checkoutDebt" class="btn btn-primary">Debt</button>
                    </div>
                @endif

                {{--Debtor Exists Or Not--}}
                @if(isset($is_checkout_with_debt) and $is_checkout_with_debt)
                    <div style="margin-top:10px;">
                        <h1>Is The Debtor Exists?</h1>
                        <button class="btn btn-info" wire:click="checkoutDebtorExists">Yes</button>
                        <button class="btn btn-primary" wire:click="createNewDebtorForm">No</button>
                    </div>
                @endif

                {{--Debtor Exists--}}
                @if(isset($is_checkout_with_debtor_exists) and $is_checkout_with_debtor_exists)
                    <div class="form-group mb-3">
                        <div class="mt-4">
                            <input class="form-control" placeholder="Name or Phone Number"
                                   type="text" wire:model.debounce.500ms="debtorSearchKeyword">
                        </div>
                    </div>

                    {{--Search Result--}}
                    @if($debtorSearchKeyword != '' or $debtorSearchKeyword != null)
                        <div class="row">
                            @forelse($debtorsSearched as $debtor)
                                <div class="col">
                                    <div class="card card-stats" style="background: rgb(0 0 0 / 8%);">
                                        <!-- Card body -->
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <button class="btn"
                                                        wire:click="whoToAskForDebtsDue('{{$debtor->id}}')">
                                                    <div class="col">
                                                        {{--Product Name--}}
                                                        <h4 class="card-title mb-0">id: {{$debtor->id}} </h4>
                                                        <h4 class="card-title mb-0">Name: {{$debtor->name}} </h4>

                                                        {{--Product Cost--}}
                                                        <span class="d-block mb-0">Phone: {{$debtor->phone}}</span>
                                                        {{--Product Price--}}
                                                        <span class="mb-0">Total: {{$debtor->debts_sum_price}}TL</span>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @empty
                                {{--Debtor Not Exists--}}
                                <h1>No Results</h1>
                                <br>
                                <div>
                                    <button class="btn btn-success" wire:click="createNewDebtorForm">Create</button>
                                </div>
                            @endforelse
                        </div>
                    @endif
                @endif

                @if(isset($is_ask_for_debts_due))
                    @if($is_ask_for_debts_due)
                    <!-- Modal -->
                        <div class="modal fade" id="askForDueModal" tabindex="-1" role="dialog"
                             aria-labelledby="askForDueModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="askForDueModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h1>Set A Due: </h1>
                                        <input type="date" min="{{\Carbon\Carbon::now()->toDateString()}}"
                                               wire:model.defer="due_date">
                                        <p>Default: After One Month From Now</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                        <button type="button" class="btn btn-primary"
                                                wire:click="createDebtsFromCart('{{$whoToAskForDebtsDueDebtorId}}')">
                                            Save changes
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif

            </div>
            {{--Create New Debtor Form--}}
            @if(isset($is_create_new_debtor_form))
                @if($is_create_new_debtor_form)
                    @include('livewire.debts.create-new-debtor-component')
                @endif
            @endif
        </div>
    </div>


    <script>
        Livewire.on('askForDueEvent', debtorId => {
            $('#askForDueModal').modal('show');
        })

        Livewire.on('amountError', function () {
            $('#amountError').css({display: "block"});
        })
    </script>
</div>
