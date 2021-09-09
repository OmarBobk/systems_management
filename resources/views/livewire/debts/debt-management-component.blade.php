<div>
    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            <form>
                <div class="form-group mb-3">
                    <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-search"></i></span>
                        </div>
                        <input class="form-control" placeholder="Search"
                               type="text" wire:model.debounce.500ms="searchKeyword">
                    </div>
                </div>
            </form>

            {{--Search Result--}}
            @if($searchKeyword != '' or $searchKeyword != null)
                @include('livewire.debts.searchResult-component')
            @endif

            {{-- New Debtor Form --}}
            @if(isset($is_create_new_debtor) and $is_create_new_debtor)
                @include('livewire.debts.create-new-debtor-component')
            @endif

            {{--Debtors--}}
            <div>
                <button class="btn btn-primary" wire:click="addNewDebtor">New Debtor</button>
                <table class="table-fixed w-full">
                    <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Phone</th>
                        <th class="px-4 py-2">Total</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($debtors))
                        @forelse($debtors as $debtor)
                            <tr>
                                <td class="border px-4 py-2">{{$debtor->id}}</td>
                                <td class="border px-4 py-2" wire:click="editName('{{$debtor->id}}')">
                                    @if(isset($editName[$debtor->id]))
                                        @if($editName[$debtor->id])
                                            <input type="text"
                                                   class="form-control"
                                                   wire:model.lazy="name.{{$debtor->id}}"
                                                   wire:keydown.enter="updateNameEnter('{{$debtor->id}}')"
                                                   wire:keydown.escape="closeUpdateNameEnter('{{$debtor->id}}')">
                                        @else
                                            {{$debtor->name}}
                                        @endif
                                    @else
                                        {{$debtor->name}}
                                    @endif
                                </td>

                                {{--Phone--}}
                                <td class="border px-4 py-2" wire:click="editPhone('{{$debtor->id}}')">
                                    @if(isset($editPhone[$debtor->id]))
                                        @if($editPhone[$debtor->id])
                                            <input type="text"
                                                   class="form-control"
                                                   wire:model.lazy="phone.{{$debtor->id}}"
                                                   wire:keydown.enter="updatePhoneEnter('{{$debtor->id}}')"
                                                   wire:keydown.escape="closeUpdatePhoneEnter('{{$debtor->id}}')">
                                        @else
                                            {{$debtor->phone}}
                                        @endif
                                    @else
                                        {{$debtor->phone}}
                                    @endif
                                </td>

                                {{--Total--}}
                                <td class="border px-4 py-2">{{DB::table('debts')->whereDebtorId($debtor->id)->whereIsPaid(0)->sum(\DB::raw('price * amount'))}}</td>

                                {{--Actions--}}
                                <td class="border px-4 py-2">
                                    @if(isset($editName[$debtor->id]) or isset($editPhone[$debtor->id]))
                                        @if($editName[$debtor->id] or $editPhone[$debtor->id])
                                            <button class="btn-success btn-sm"
                                                    wire:click="@if ($editName[$debtor->id]) updateNameEnter('{{$debtor->id}}') @else updatePhoneEnter('{{$debtor->id}}') @endif">
                                                <i class="ni ni-2x ni-active-40"></i>
                                            </button>

                                            <button class="btn-danger btn-sm"
                                                    wire:click="@if ($editName[$debtor->id]) closeUpdateNameEnter('{{$debtor->id}}') @else closeUpdatePhoneEnter('{{$debtor->id}}') @endif">
                                                <i class="ni ni-2x ni-fat-remove"></i>
                                            </button>
                                        @else
                                            <button class="btn-primary btn-sm"
                                                    wire:click="viewDebts('{{$debtor->id}}')">
                                                <i class="ni ni-2x ni-bold-down"></i>
                                            </button>
                                        @endif
                                    @else
                                        <button class="btn-primary btn-sm"
                                                wire:click="viewDebts('{{$debtor->id}}')">
                                            <i class="ni ni-2x ni-bold-down"></i>
                                        </button>
                                    @endif

                                </td>
                            </tr>

                            {{--Debts Table--}}
                            @if(isset($is_view_debts[$debtor->id]))
                                @if($is_view_debts[$debtor->id])
                                    <tr>
                                        <td colspan="10" class="border text-center px-4 py-2">
                                            <table class="table-fixed w-full">
                                                <thead>
                                                    <tr class="bg-gray-100">
                                                        <th class="px-4 py-2 w-20">No</th>
                                                        <th class="px-4 py-2">Name</th>
                                                        <th class="px-4 py-2">Description</th>
                                                        <th class="px-4 py-2">Amount</th>
                                                        <th class="px-4 py-2">Cost</th>
                                                        <th class="px-4 py-2">Price</th>
                                                        <th class="px-4 py-2">Total</th>
                                                        <th class="px-4 py-2">Is Paid?</th>
                                                        <th class="px-4 py-2">Due</th>
                                                        <th class="px-4 py-2">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($debtor->debts as $debt)
                                                        <tr>
                                                            <td class="border text-center px-4 py-2">{{$loop->index + 1}}</td>

                                                            {{--Item Name--}}
                                                            <td class="border text-center px-4 py-2" wire:click="editItemName('{{$debtor->id}}', '{{$debt->id}}')">
                                                                @if(isset($is_debt_name[$debtor->id][$debt->id]))
                                                                    @if($is_debt_name[$debtor->id][$debt->id])
                                                                        <input type="text"
                                                                               class="form-control"
                                                                               wire:model.lazy="debt_name.{{$debtor->id}}.{{$debt->id}}"
                                                                               wire:keydown.enter="updateDebtItemName('{{$debtor->id}}', '{{$debt->id}}')"
                                                                               wire:keydown.escape="closeItemName('{{$debtor->id}}', '{{$debt->id}}')">
                                                                    @else
                                                                        {{$debt->item_name}}
                                                                    @endif
                                                                @else
                                                                    {{$debt->item_name}}
                                                                @endif
                                                            </td>

                                                            {{--Description--}}
                                                            <td class="border text-center px-4 py-2" wire:click="editDescription('{{$debtor->id}}', '{{$debt->id}}')">
                                                                @if(isset($is_debt_description[$debtor->id][$debt->id]))
                                                                    @if($is_debt_description[$debtor->id][$debt->id])
                                                                        <input type="text"
                                                                               class="form-control"
                                                                               wire:model.lazy="debt_description.{{$debtor->id}}.{{$debt->id}}"
                                                                               wire:keydown.enter="updateDebtDescription('{{$debtor->id}}', '{{$debt->id}}')"
                                                                               wire:keydown.escape="closeDescription('{{$debtor->id}}', '{{$debt->id}}')">
                                                                    @else
                                                                        {{$debt->description}}
                                                                    @endif
                                                                @else
                                                                    {{$debt->description}}
                                                                @endif
                                                            </td>

                                                            {{--Amount--}}
                                                            <td class="border text-center px-4 py-2" wire:click="editAmount('{{$debtor->id}}', '{{$debt->id}}')">
                                                                @if(isset($is_debt_amount[$debtor->id][$debt->id]))
                                                                    @if($is_debt_amount[$debtor->id][$debt->id])
                                                                        <input type="text"
                                                                               class="form-control"
                                                                               wire:model.lazy="debt_amount.{{$debtor->id}}.{{$debt->id}}"
                                                                               wire:keydown.enter="updateDebtAmount('{{$debtor->id}}', '{{$debt->id}}')"
                                                                               wire:keydown.escape="closeAmount('{{$debtor->id}}', '{{$debt->id}}')">
                                                                    @else
                                                                        {{$debt->amount}}
                                                                    @endif
                                                                @else
                                                                    {{$debt->amount}}
                                                                @endif
                                                            </td>

                                                            {{--Cost--}}
                                                            <td class="border text-center px-4 py-2" wire:click="editCost('{{$debtor->id}}', '{{$debt->id}}')">
                                                                @if(isset($is_debt_cost[$debtor->id][$debt->id]))
                                                                    @if($is_debt_cost[$debtor->id][$debt->id])
                                                                        <input type="text"
                                                                               class="form-control"
                                                                               wire:model.lazy="debt_cost.{{$debtor->id}}.{{$debt->id}}"
                                                                               wire:keydown.enter="updateDebtCost('{{$debtor->id}}', '{{$debt->id}}')"
                                                                               wire:keydown.escape="closeCost('{{$debtor->id}}', '{{$debt->id}}')">
                                                                    @else
                                                                        {{$debt->cost}}
                                                                    @endif
                                                                @else
                                                                    {{$debt->cost}}
                                                                @endif
                                                            </td>

                                                            {{--Price--}}
                                                            <td class="border text-center px-4 py-2" wire:click="editPrice('{{$debtor->id}}', '{{$debt->id}}')">
                                                                @if(isset($is_debt_price[$debtor->id][$debt->id]))
                                                                    @if($is_debt_price[$debtor->id][$debt->id])
                                                                        <input type="text"
                                                                               class="form-control"
                                                                               wire:model.lazy="debt_price.{{$debtor->id}}.{{$debt->id}}"
                                                                               wire:keydown.enter="updateDebtPrice('{{$debtor->id}}', '{{$debt->id}}')"
                                                                               wire:keydown.escape="closePrice('{{$debtor->id}}', '{{$debt->id}}')">
                                                                    @else
                                                                        {{$debt->price}}
                                                                    @endif
                                                                @else
                                                                    {{$debt->price}}
                                                                @endif

                                                            </td>

                                                            {{--Total--}}
                                                            <td class="border text-center px-4 py-2">
                                                                {{$debt->price  * $debt->amount}}
                                                            </td>

                                                            {{--Paid--}}
                                                            <td class="border text-center px-4 py-2" wire:click="updatePaid('{{$debt->id}}')">
                                                                @if($debt->is_paid) Paid @else Not Paid @endif
                                                            </td>

                                                            {{--Due--}}
                                                            <td class="border text-center px-4 py-2">
                                                                {{$debt->due}}
                                                            </td>
                                                            {{--Actions--}}
                                                            <td class="border text-center px-4 py-2">
                                                                @if(isset($is_debt_name[$debtor->id][$debt->id]) or isset($is_debt_description[$debtor->id][$debt->id]) or isset($is_debt_cost[$debtor->id][$debt->id]) or isset($is_debt_price[$debtor->id][$debt->id]) or isset($is_debt_paid[$debtor->id][$debt->id]) or isset($is_debt_amount[$debtor->id][$debt->id]))
                                                                    @if($is_debt_name[$debtor->id][$debt->id] or $is_debt_description[$debtor->id][$debt->id] or $is_debt_cost[$debtor->id][$debt->id] or $is_debt_price[$debtor->id][$debt->id] or $is_debt_paid[$debtor->id][$debt->id] or $is_debt_amount[$debtor->id][$debt->id])
                                                                        <button class="btn-success btn-sm"
                                                                                wire:click="determineWhatToUpdate({{$debtor->id}}, {{$debt->id}})">
                                                                            <i class="ni ni-2x ni-active-40"></i>
                                                                        </button>

                                                                        <button class="btn-danger btn-sm"
                                                                                wire:click="determineWhatToClose({{$debtor->id}}, {{$debt->id}})">
                                                                            <i class="ni ni-2x ni-fat-remove"></i>
                                                                        </button>
                                                                    @endif
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr class="bg-gray-100">
                                                            <td colspan="10" class="border text-center px-4 py-2">You don't have any debts yet!!.</td>
                                                        </tr>
                                                    @endforelse
                                                    {{--New Debtor Form--}}
                                                    <tr>
                                                        <td colspan="10">
                                                            @if(isset($is_create_new_debt) and $is_create_new_debt)
                                                                @include('livewire.debts.create-new-debt-component')
                                                            @endif
                                                        </td>
                                                    </tr>

                                                    {{--Create New Debt--}}
                                                    <tr>
                                                        <td class="border text-center px-4 py-2">
                                                            <button class="btn-primary btn-sm float-right"
                                                                    wire:click="createNewDebt('{{$debtor->id}}')">
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
                            <td colspan="10" class="border text-center px-4 py-2">You don't have any debtors yet!!.</td>
                        </tr>
                    @endif

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
