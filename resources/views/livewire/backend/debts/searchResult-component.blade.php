<div>
        @forelse($results as $debtor)
            <div class="row">
                <div class="col-3">
                    <div class="card card-stats" style="background: rgb(0 0 0 / 8%);">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <a href="#" wire:click="showDebtsFromSearch('{{$debtor->id}}')">
                                    <div class="col">
                                        {{--Product Name--}}
                                        <h4 class="card-title mb-0">Name: {{$debtor->name}} </h4>

                                        {{--Product Cost--}}
                                        <span class="d-block mb-0">Phone: {{$debtor->phone}}</span>
                                        {{--Product Price--}}
                                        <span class="mb-0">Total: {{$debtor->debts_sum_price}}TL</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @if(isset($is_show_debts_from_search[$debtor->id]) and $is_show_debts_from_search[$debtor->id] == true)
                        <div class="col-9 overflow-auto">
                            {{--Debtors--}}
                            <div>
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
                                            <td class="border px-4 py-2">{{DB::table('debts')->whereDebtorId($debtor->id)->whereIsPaid(0)->sum(DB::raw('price * amount'))}}</td>

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
                                                                wire:click="viewDebtFromSearchForm('{{$debtor->id}}')">
                                                            <i class="ni ni-2x ni-bold-down"></i>
                                                        </button>
                                                    @endif
                                                @else
                                                    <button class="btn-primary btn-sm"
                                                            wire:click="viewDebtFromSearchForm('{{$debtor->id}}')">
                                                        <i class="ni ni-2x ni-bold-down"></i>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>

                                        {{--Debts Table--}}
                                        @if(isset($is_view_debts_from_search_form[$debtor->id]))
                                            @if($is_view_debts_from_search_form[$debtor->id])
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
                                                                    <td class="border text-center px-4 py-2">{{$debt->id}}</td>

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

                                                                    <td class="border text-center px-4 py-2" wire:click="updatePaid('{{$debt->id}}')">
                                                                        @if($debt->is_paid) Paid @else Not Paid @endif
                                                                    </td>
                                                                    <td class="border text-center px-4 py-2">{{$debt->due}}</td>
                                                                    <td class="border text-center px-4 py-2">

                                                                        {{--Actions--}}
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
