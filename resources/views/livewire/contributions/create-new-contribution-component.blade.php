<div>
    <table class="table-fixed w-full">
        <thead>
        <tr class="bg-gray-100">
            <th class="px-4 py-2">Amount</th>
            <th class="px-4 py-2">Description</th>
            <th class="px-4 py-2">Profits</th>
            <th class="px-4 py-2">Deposit</th>
            <th class="px-4 py-2">Due</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
        </thead>
        <tbody>
            <tr>

                {{--Amount--}}
                <td class="border text-center px-4 py-2">
                    <label>
                        <input type="number"
                               class="form-control"
                               wire:model="new_contribution_amount">
                    </label>
                    @error('new_contribution_amount') <h1 class="alert alert-danger">{{$message}}</h1>@enderror
                </td>

                {{--Description--}}
                <td class="border text-center px-4 py-2">
                    <label>
                        <textarea
                            class="form-control"
                           wire:model.lazy="new_contribution_description"
                           wire:keydown.enter="storeContribution('{{$contributor->id}}')"
                           wire:keydown.escape="closeCreateContributionComponent"></textarea>
                    </label>
                    @error('new_contribution_description') <h1 class="alert alert-danger">{{$message}}</h1>@enderror
                </td>

                {{--ProfitsPercent--}}
                <td class="border text-center px-4 py-2">
                    <label>
                        <input type="text"
                               class="form-control"
                               wire:model.lazy="new_contribution_profits_percent"
                               wire:keydown.enter="storeContribution('{{$contributor->id}}')"
                               wire:keydown.escape="closeCreateContributionComponent">
                    </label>
                    @error('new_contribution_profits_percent') <h1 class="alert alert-danger">{{$message}}</h1>@enderror
                </td>

                {{--Deposit--}}
                <td class="border text-center px-4 py-2">
                    <label>
                        <input type="date"
                               class="form-control"
                               wire:model.lazy="new_contribution_deposit_date"
                               wire:keydown.enter="storeContribution('{{$contributor->id}}')"
                               wire:keydown.escape="closeCreateContributionComponent">
                    </label>
                    @error('new_contribution_deposit_date') <h1 class="alert alert-danger">{{$message}}</h1>@enderror
                </td>

                {{--Due--}}
                <td class="border text-center px-4 py-2">
                    <label>
                        <input type="date"
                               class="form-control"
                               wire:model.lazy="new_contribution_due_date"
                               wire:keydown.enter="storeContribution('{{$contributor->id}}')"
                               wire:keydown.escape="closeCreateContributionComponent">
                    </label>
                    @error('new_contribution_due_date') <h1 class="alert alert-danger">{{$message}}</h1>@enderror
                </td>

                {{--Actions--}}
                <td class="border text-center px-4 py-2">
                    <button class="btn-success btn-sm float-right"
                            wire:click="storeContribution('{{$contributor->id}}')">
                        <i class="fa fa-sign-in-alt fa-2x"></i>
                    </button>

                    <button class="btn-danger btn-sm float-right"
                            wire:click="closeCreateContributionComponent">
                        <i class="fa fa-window-close fa-2x"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>

</div>
