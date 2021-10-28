<div>
    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            {{-- New Expense Form --}}
            @if(isset($is_create_new_expense) and $is_create_new_expense)
                @include('livewire.expenses.create-new-expense-component', $contributors)
            @endif

            {{-- Expenses --}}
            <div>
                <button class="btn btn-primary" wire:click="addNewExpense">New Expense</button>
                <table class="table-fixed w-full">
                    <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No</th>
                        <th class="px-4 py-2">Type</th>
                        <th class="px-4 py-2">Description</th>
                        <th class="px-4 py-2">Amount</th>
                        <th class="px-4 py-2">Contributor</th>
                        <th class="px-4 py-2">By</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($expenses))
                        @forelse($expenses as $expense)
                            <tr>
                                <td class="border px-4 py-2">{{$expense->id}}</td>

                                {{--Expense Type--}}
                                    @if(isset($editType[$expense->id]))
                                        @if($editType[$expense->id])
                                        <td class="border px-4 py-2">

                                                <select class="form-control"
                                                        wire:model="type.{{$expense->id}}">
                                                    <option >...</option>
                                                    <option value="shopping">Shopping</option>
                                                    <option value="store">Store</option>
                                                    <option value="loses">Loses</option>
                                                </select>

                                            @error("type.$expense->id") <span class="text-red-500">{{ $message }}</span> @enderror
                                        </td>
                                        @else
                                        <td class="border px-4 py-2" wire:click="editType('{{$expense->id}}')">
                                            {{$expense->type}}
                                        </td>
                                        @endif
                                    @else
                                    <td class="border px-4 py-2" wire:click="editType('{{$expense->id}}')">
                                        {{$expense->type}}
                                    </td>
                                    @endif

                                {{--Description--}}
                                <td class="border px-4 py-2" wire:click="editDescription('{{$expense->id}}')">
                                    @if(isset($editDescription[$expense->id]))
                                        @if($editDescription[$expense->id])

                                                <textarea
                                                    class="form-control"
                                                    wire:model.lazy="description.{{$expense->id}}"
                                                    wire:keydown.escape="closeUpdateDescriptionEnter('{{$expense->id}}')"
                                                ></textarea>

                                        @else
                                            {{$expense->description}}
                                        @endif
                                    @else
                                        {{$expense->description}}
                                    @endif
                                    @error("description.$expense->id") <span class="text-red-500">{{ $message }}</span> @enderror
                                </td>

                                {{--Amount--}}
                                <td class="border px-4 py-2" wire:click="editAmount('{{$expense->id}}')">
                                    @if(isset($editAmount[$expense->id]))
                                        @if($editAmount[$expense->id])

                                                <input type="number"
                                                       class="form-control"
                                                       wire:model.lazy="amount.{{$expense->id}}"
                                                       wire:keydown.escape="closeUpdateAmountEnter('{{$expense->id}}')"
                                                       wire:keydown.enter="updateAmountEnter('{{$expense->id}}')"
                                                />

                                        @else
                                            {{$expense->amount}}
                                        @endif
                                    @else
                                        {{$expense->amount}}
                                    @endif
                                    @error("amount.$expense->id") <span class="text-red-500">{{ $message }}</span> @enderror
                                </td>

                                {{--Contribution Id--}}
                                    @if(isset($editContributionId[$expense->id]))
                                        @if($editContributionId[$expense->id])
                                        <td class="border px-4 py-2">

                                                <select class="form-control"
                                                        wire:model="contribution_id.{{$expense->id}}">
                                                    <option >...</option>
                                                    @forelse($expense->contribution->contributor->get() as $contributor)
                                                        <option value="{{$contributor->id}}">{{$contributor->name}}</option>
                                                    @empty
                                                    @endforelse
                                                </select>

                                        </td>
                                        @else
                                        <td class="border px-4 py-2" wire:click="editContributionId('{{$expense->id}}')">
                                            {{$expense->contribution->contributor->name}}
                                        </td>
                                        @endif
                                    @else
                                    <td class="border px-4 py-2" wire:click="editContributionId('{{$expense->id}}')">
                                        {{$expense->contribution->contributor->name}}
                                    </td>
                                    @endif
                                    @error("contribution_id.$expense->id") <span class="text-red-500">{{ $message }}</span> @enderror

                                {{--User--}}
                                <td class="border px-4 py-2">
                                    {{$expense->user->name}}
                                </td>

                                {{--Actions--}}
                                <td class="border px-4 py-2">
                                    @if(isset($editType[$expense->id]) or isset($editDescription[$expense->id]) or isset($editAmount[$expense->id]) or isset($editContributionId[$expense->id]))
                                        @if($editType[$expense->id] or $editDescription[$expense->id] or $editAmount[$expense->id] or $editContributionId[$expense->id])

                                            {{--Update Button--}}
                                            <button class="btn-success btn-sm"
                                                    wire:click="@if ($editType[$expense->id]) updateTypeEnter('{{$expense->id}}') @elseif($editAmount[$expense->id]) updateAmountEnter('{{$expense->id}}')  @elseif($editContributionId[$expense->id]) updateContributionIdEnter('{{$expense->id}}') @else updateDescriptionEnter('{{$expense->id}}') @endif">
                                                <i class="ni ni-2x ni-active-40"></i>
                                            </button>

                                            {{--Close Button--}}
                                            <button class="btn-danger btn-sm"
                                                    wire:click="@if ($editType[$expense->id]) closeUpdateTypeEnter('{{$expense->id}}') @elseif($editAmount[$expense->id]) closeUpdateAmountEnter('{{$expense->id}}')  @elseif($editContributionId[$expense->id]) closeUpdateContributionIdEnter('{{$expense->id}}') @else closeUpdateDescriptionEnter('{{$expense->id}}') @endif">
                                                <i class="ni ni-2x ni-fat-remove"></i>
                                            </button>
                                        @endif
                                    @endif

                                </td>
                            </tr>

                        @empty
                        @endforelse
                    @else
                        <tr>
                            <td colspan="10" class="border text-center px-4 py-2">You don't have any Expenses yet!!.</td>
                        </tr>
                    @endif

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
