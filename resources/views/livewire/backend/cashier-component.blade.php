<div>
    <div class="container-fluid mt--6">
        <div class="bg-white card shadow-xl sm:rounded-lg px-4 py-4">

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
                <div class="bg-teal-100  border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                     role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm alert alert-danger">Sana Karman is Amazing</p>
                        </div>
                    </div>
                </div>

            @if(session()->has('sales_message'))
                <div class="bg-teal-100  border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                 role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm alert alert-{{session('sales_alert')}}">{{session('sales_message')}}</p>
                    </div>
                </div>
            </div>
            @endif
            @if(session()->has('debts_message'))
                <div class="bg-teal-100  border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                 role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm alert alert-{{session('debts_alert')}}">{{session('debts_message')}}</p>
                    </div>
                </div>
            </div>
            @endif

            <form>
                <div class="form-group mb-[0rem] px-[15px]">
                    <div class="input-group input-group-merge input-group-alternative">
                        <input class="form-control" placeholder="Search"
                               type="text" wire:model.debounce.500ms="searchKeyword">
                    </div>
                </div>
            </form>

            {{--Search Result--}}
            @if($searchKeyword != '' or $searchKeyword != null)
                @include('livewire.backend.search.result-component', $result)
            @endif

                <div class=" mx-[1rem] mt-[1rem] p-[1rem] bg-gray-50 flex flex-col sm:flex-row gap-[1rem] ">
                    <x-data-filter :datepicker="true"
                                   :menu_data="$this->menu_data"
                    ></x-data-filter>


                </div>

            {{--Card--}}
            <div class="px-[15px] mt-[1rem]">

                <x-dataset :table_data="$this->table_data"
                           :is_edit="$this->is_edit"
                           :editable_type="$this->editable_type"
                ></x-dataset>
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


    @push('scripts')
        <script>
            Livewire.on('askForDueEvent', debtorId => {
                $('#askForDueModal').modal('show');
            })

            Livewire.on('amountError', function () {
                $('#amountError').css({display: "block"});
            })
        </script>
    @endpush
</div>
