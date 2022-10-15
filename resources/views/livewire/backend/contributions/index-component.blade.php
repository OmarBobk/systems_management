<div>
    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            {{-- New Contributor Form --}}
            @if(isset($is_create_new_contributor) and $is_create_new_contributor)
                @include('livewire.contributions.create-new-contributor-component')
            @endif

            {{-- Contributors --}}
            <div>
                <button class="btn btn-primary" wire:click="addNewContributor">New Contributor</button>
                <table class="mt-4 w-full">
                    <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Phone</th>
                        <th class="px-4 py-2">Total</th>
                        <th class="px-4 py-2">Notes</th>
                        <th class="px-4 py-2">Profile</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($contributors))
                        @forelse($contributors as $contributor)
                            <tr>
                                <td class="border px-4 py-2">{{$contributor->id}}</td>

                                {{--Contributor Name--}}
                                <td class="border px-4 py-2" wire:click="editName('{{$contributor->id}}')">
                                    @if(isset($editName[$contributor->id]))
                                        @if($editName[$contributor->id])
                                            <label>
                                                <input type="text"
                                                       class="form-control"
                                                       wire:model.lazy="name.{{$contributor->id}}"
                                                       wire:keydown.enter="updateNameEnter('{{$contributor->id}}')"
                                                       wire:keydown.escape="closeUpdateNameEnter('{{$contributor->id}}')">
                                            </label>
                                        @else
                                            {{$contributor->name}}
                                        @endif
                                    @else
                                        {{$contributor->name}}
                                    @endif
                                </td>

                                {{--Phone--}}
                                <td class="border px-4 py-2" wire:click="editPhone('{{$contributor->id}}')">
                                    @if(isset($editPhone[$contributor->id]))
                                        @if($editPhone[$contributor->id])
                                            <label>
                                                <input type="text"
                                                       class="form-control"
                                                       wire:model.lazy="phone.{{$contributor->id}}"
                                                       wire:keydown.enter="updatePhoneEnter('{{$contributor->id}}')"
                                                       wire:keydown.escape="closeUpdatePhoneEnter('{{$contributor->id}}')">
                                            </label>
                                        @else
                                            {{$contributor->phone}}
                                        @endif
                                    @else
                                        {{$contributor->phone}}
                                    @endif
                                </td>

                                {{--Total--}}
                                <td class="border px-4 py-2">{{number_format(\Illuminate\Support\Facades\DB::table('contributions')->whereContributorId($contributor->id)->whereStatus(0)->sum(\Illuminate\Support\Facades\DB::raw('amount'))/1000,3)}}</td>

                                {{--Notes--}}
                                <td class="border px-4 py-2" wire:click="editNotes('{{$contributor->id}}')">
                                    @if(isset($editNotes[$contributor->id]))
                                        @if($editNotes[$contributor->id])
                                            <label>
                                                <textarea class`="form-control"
                                                          wire:model.lazy="notes.{{$contributor->id}}"
                                                          wire:`keydown.escape="closeUpdateNotesEnter('{{$contributor->id}}')"></textarea>
                                            </label>
                                        @else
                                            {{$contributor->notes}}
                                        @endif
                                    @else
                                        {{$contributor->notes}}
                                    @endif
                                </td>

                                {{--Profile--}}
                                <td class="border px-4 py-2">
                                    <a href="{{route('backend.contributor', $contributor->id)}}">Details</a>
                                </td>

                                {{--Actions--}}
                                <td class="border px-4 py-2">
                                    @if(isset($editName[$contributor->id]) or isset($editPhone[$contributor->id]) or isset($editNotes[$contributor->id]))
                                        @if($editName[$contributor->id] or $editPhone[$contributor->id] or $editNotes[$contributor->id])
                                            <button class="btn-success btn-sm"
                                                    wire:click="@if ($editName[$contributor->id]) updateNameEnter('{{$contributor->id}}') @elseif($editNotes[$contributor->id]) updateNotesEnter('{{$contributor->id}}') @else updatePhoneEnter('{{$contributor->id}}') @endif">
                                                <i class="ni ni-2x ni-active-40"></i>
                                            </button>

                                            <button class="btn-danger btn-sm"
                                                    wire:click="@if ($editName[$contributor->id]) closeUpdateNameEnter('{{$contributor->id}}') @elseif($editNotes[$contributor->id]) closeUpdateNotesEnter('{{$contributor->id}}') @else closeUpdatePhoneEnter('{{$contributor->id}}') @endif">
                                                <i class="ni ni-2x ni-fat-remove"></i>
                                            </button>
                                        @else
                                            <button class="btn-primary btn-sm"
                                                    wire:click="viewContributions('{{$contributor->id}}')">
                                                <i class="ni ni-2x ni-bold-down"></i>
                                            </button>
                                        @endif
                                    @else
                                        <button class="btn-primary btn-sm"
                                                wire:click="viewContributions('{{$contributor->id}}')">
                                            <i class="ni ni-2x ni-bold-down"></i>
                                        </button>
                                    @endif

                                </td>
                            </tr>

                            {{--Contributions Table--}}
                            @if(isset($is_view_contributions[$contributor->id]))
                                @if($is_view_contributions[$contributor->id])
                                    <tr>
                                        <td colspan="7" class="border text-center py-3 px-3">
                                            <table class="w-full table-fixed">
                                                <thead>
                                                <tr class="bg-gray-100">
                                                    <th class="px-2 py-2 w-20">No</th>
                                                    <th class="px-2 py-2">Amount</th>
                                                    <th class="px-2 py-2">Description</th>
                                                    <th class="px-2 py-2">Profits Percent</th>
                                                    <th class="px-2 py-2">Profits</th>
                                                    <th class="px-2 py-2">Deposit</th>
                                                    <th class="px-2 py-2">Due</th>
                                                    <th class="px-2 py-2">Status</th>
                                                    <th class="px-2 py-2">Returned</th>
                                                    <th class="px-2 py-2">Updated at</th>
                                                    <th class="px-2 py-2">Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($contributor->contributions as $contribution)
                                                    <tr>
                                                        <td class="border text-center px-2 py-2">{{$loop->index + 1}}</td>

                                                        {{--Amount--}}
                                                        <td class="border text-center px-2 py-2" wire:click="editAmount('{{$contributor->id}}', '{{$contribution->id}}')">
                                                            @if(isset($is_contribution_amount[$contributor->id][$contribution->id]))
                                                                @if($is_contribution_amount[$contributor->id][$contribution->id])
                                                                    <label>
                                                                        <input type="text"
                                                                               class="form-control"
                                                                               wire:model.lazy="contribution_amount.{{$contributor->id}}.{{$contribution->id}}"
                                                                               wire:keydown.enter="updateContributionAmount('{{$contributor->id}}', '{{$contribution->id}}')"
                                                                               wire:keydown.escape="closeAmount('{{$contributor->id}}', '{{$contribution->id}}')">
                                                                    </label>
                                                                @else
                                                                    {{number_format($contribution->amount/1000,3)}}
                                                                @endif
                                                            @else
                                                                {{number_format($contribution->amount/1000,3)}}
                                                            @endif
                                                            @error("contribution_amount.$contributor->id.$contribution->id") <h1 class="alert alert-danger">{{$message}}</h1>@enderror
                                                        </td>

                                                        {{--Description--}}
                                                        <td class="border text-center px-2 py-2" wire:click="editDescription('{{$contributor->id}}', '{{$contribution->id}}')">
                                                            @if(isset($is_contribution_description[$contributor->id][$contribution->id]))
                                                                @if($is_contribution_description[$contributor->id][$contribution->id])
                                                                    <label>
                                                                        <textarea
                                                                            rows="10"
                                                                            cols="10"
                                                                           class="form-control"
                                                                           wire:model.lazy="contribution_description.{{$contributor->id}}.{{$contribution->id}}"
                                                                           wire:keydown.escape="closeDescription('{{$contributor->id}}', '{{$contribution->id}}')"></textarea>
                                                                    </label>
                                                                @else
                                                                    {{$contribution->description}}
                                                                @endif
                                                            @else
                                                                {{$contribution->description}}
                                                            @endif
                                                        </td>

                                                        {{--ProfitsPercent--}}
                                                        <td class="border text-center px-2 py-2" wire:click="editProfitsPercent('{{$contributor->id}}', '{{$contribution->id}}')">
                                                            @if(isset($is_contribution_profits_percent[$contributor->id][$contribution->id]))
                                                                @if($is_contribution_profits_percent[$contributor->id][$contribution->id])
                                                                    <label>
                                                                        <input type="text"
                                                                               class="form-control"
                                                                               wire:model.lazy="contribution_profits_percent.{{$contributor->id}}.{{$contribution->id}}"
                                                                               wire:keydown.enter="updateContributionProfitsPercent('{{$contributor->id}}', '{{$contribution->id}}')"
                                                                               wire:keydown.escape="closeProfitsPercent('{{$contributor->id}}', '{{$contribution->id}}')">
                                                                    </label>
                                                                @else
                                                                    {{$contribution->profits_percent}}%
                                                                @endif
                                                            @else
                                                                {{$contribution->profits_percent}}%
                                                            @endif
                                                        </td>

                                                        {{--profits_sum_amount--}}
                                                        <td class="border text-center px-2 py-2">
                                                            {{number_format($contribution->profits_sum_amount/1000, 3)}}
                                                        </td>

                                                        {{--Deposit--}}
                                                        <td class="border text-center px-2 py-2" wire:click="editDepositDate('{{$contributor->id}}', '{{$contribution->id}}')">
                                                            @if(isset($is_contribution_deposit_date[$contributor->id][$contribution->id]))
                                                                @if($is_contribution_deposit_date[$contributor->id][$contribution->id])
                                                                    <label>
                                                                        <input type="date"
                                                                               class="form-control"
                                                                               wire:model.lazy="contribution_deposit_date.{{$contributor->id}}.{{$contribution->id}}"
                                                                               wire:keydown.enter="updateContributionDepositDate('{{$contributor->id}}', '{{$contribution->id}}')"
                                                                               wire:keydown.escape="closeDepositDate('{{$contributor->id}}', '{{$contribution->id}}')">
                                                                    </label>
                                                                @else
                                                                    {{$contribution->deposit_date}}
                                                                @endif
                                                            @else
                                                                {{$contribution->deposit_date}}
                                                            @endif
                                                        </td>

                                                        {{--Due--}}
                                                        <td class="border text-center px-2 py-2" wire:click="editDueDate('{{$contributor->id}}', '{{$contribution->id}}')">
                                                            @if(isset($is_contribution_due_date[$contributor->id][$contribution->id]))
                                                                @if($is_contribution_due_date[$contributor->id][$contribution->id])
                                                                    <label>
                                                                        <input type="date"
                                                                               class="form-control"
                                                                               wire:model.lazy="contribution_due_date.{{$contributor->id}}.{{$contribution->id}}"
                                                                               wire:keydown.enter="updateContributionDueDate('{{$contributor->id}}', '{{$contribution->id}}')"
                                                                               wire:keydown.escape="closeDueDate('{{$contributor->id}}', '{{$contribution->id}}')">
                                                                    </label>
                                                                @else
                                                                    {{$contribution->due_date}}
                                                                @endif
                                                            @else
                                                                {{$contribution->due_date}}
                                                            @endif
                                                        </td>

                                                        {{--Status--}}
                                                        <td class="border text-center px-2 py-2" wire:click="editStatus('{{$contributor->id}}', '{{$contribution->id}}')">
                                                            @if(isset($is_contribution_status[$contributor->id][$contribution->id]))
                                                                @if($is_contribution_status[$contributor->id][$contribution->id])
                                                                    <label>
                                                                        <input type="text"
                                                                               class="form-control"
                                                                               wire:model.lazy="contribution_status.{{$contributor->id}}.{{$contribution->id}}"
                                                                               wire:keydown.enter="updateContributionStatus('{{$contributor->id}}', '{{$contribution->id}}')"
                                                                               wire:keydown.escape="closeStatus('{{$contributor->id}}', '{{$contribution->id}}')">
                                                                    </label>
                                                                @else
                                                                    @if($contribution->status == 0)
                                                                        Working
                                                                    @else
                                                                        Returned
                                                                    @endif
                                                                @endif
                                                            @else
                                                                @if($contribution->status == 0)
                                                                    Working
                                                                @else
                                                                    Returned
                                                                @endif
                                                            @endif
                                                        </td>

                                                        {{--Returned--}}
                                                        <td class="border text-center px-2 py-2" wire:click="editReturnedDate('{{$contributor->id}}', '{{$contribution->id}}')">
                                                            @if(isset($is_contribution_returned_date[$contributor->id][$contribution->id]))
                                                                @if($is_contribution_returned_date[$contributor->id][$contribution->id])
                                                                    <label>
                                                                        <input type="date"
                                                                               class="form-control"
                                                                               wire:model.lazy="contribution_returned_date.{{$contributor->id}}.{{$contribution->id}}"
                                                                               wire:keydown.enter="updateContributionReturnedDate('{{$contributor->id}}', '{{$contribution->id}}')"
                                                                               wire:keydown.escape="closeReturnedDate('{{$contributor->id}}', '{{$contribution->id}}')">
                                                                    </label>
                                                                @else
                                                                    @if($contribution->returned_date != null)
                                                                        {{$contribution->returned_date}}
                                                                    @else
                                                                        -
                                                                    @endif
                                                                @endif
                                                            @else
                                                                @if($contribution->returned_date != null)
                                                                    {{$contribution->returned_date}}
                                                                @else
                                                                    -
                                                                @endif
                                                            @endif
                                                        </td>

                                                        {{-- Date --}}
                                                        <td class="border text-center" style="padding:15px 15px">
                                                            {{$contribution->updated_at}}
                                                        </td>

                                                        {{--Actions--}}
                                                        <td class="border text-center px-2 py-2">
                                                            @if(isset($is_contribution_description[$contributor->id][$contribution->id]) or isset($is_contribution_profits_percent[$contributor->id][$contribution->id]) or isset($is_contribution_amount[$contributor->id][$contribution->id]) or isset($is_contribution_deposit_date[$contributor->id][$contribution->id]) or isset($is_contribution_due_date[$contributor->id][$contribution->id]) or isset($is_contribution_returned_date[$contributor->id][$contribution->id]) or isset($is_contribution_status[$contributor->id][$contribution->id]))
                                                                @if($is_contribution_description[$contributor->id][$contribution->id] or $is_contribution_profits_percent[$contributor->id][$contribution->id] or $is_contribution_amount[$contributor->id][$contribution->id] or $is_contribution_deposit_date[$contributor->id][$contribution->id] or $is_contribution_due_date[$contributor->id][$contribution->id] or $is_contribution_returned_date[$contributor->id][$contribution->id] or $is_contribution_status[$contributor->id][$contribution->id])
                                                                    <button class="btn-success btn-sm"
                                                                            wire:click="determineWhatToUpdate({{$contributor->id}}, {{$contribution->id}})">
                                                                        <i class="ni ni-2x ni-active-40"></i>
                                                                    </button>

                                                                    <button class="btn-danger btn-sm"
                                                                            wire:click="determineWhatToClose({{$contributor->id}}, {{$contribution->id}})">
                                                                        <i class="ni ni-2x ni-fat-remove"></i>
                                                                    </button>
                                                                @endif
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr class="bg-gray-100">
                                                        <td colspan="11" class="border text-center px-4 py-2">You don't have any Contributions yet!!.</td>
                                                    </tr>
                                                @endforelse

                                                @if(isset($is_create_new_contribution) and $is_create_new_contribution)
                                                    {{--New Contribution Form--}}
                                                    <tr>
                                                        <td colspan="10">
                                                        @include('livewire.contributions.create-new-contribution-component')
                                                        </td>
                                                    </tr>
                                                @endif

                                                {{--Create New contribution--}}
                                                <tr>
                                                    <td class="border text-center px-4 py-2">
                                                        <button class="btn-primary btn-sm float-right"
                                                                wire:click="createNewContribution('{{$contributor->id}}')">
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
                            <td colspan="10" class="border text-center px-4 py-2">You don't have any Contributors yet!!.</td>
                        </tr>
                    @endif

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
