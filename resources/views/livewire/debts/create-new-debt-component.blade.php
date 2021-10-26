<div>
    <table class="table-fixed w-full">
        <thead>
        <tr class="bg-gray-100">
            <th class="px-4 py-2 w-25">Product</th>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Description</th>
            <th class="px-4 py-2">Amount</th>
            <th class="px-4 py-2">Cost</th>
            <th class="px-4 py-2">Price</th>
            <th class="px-4 py-2">Due</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border text-center px-4 py-2">
                    <input type="text"
                           class="form-control"
                           wire:model="productSearchKeyword">
                    @error('new_debt_product_id') <h1 class="alert alert-danger">{{$message}}</h1>@enderror
                    <div class="text-left" style="position: absolute; width:11%; background:#EEE;padding:8px;">
                        @if($productSearchKeyword != '' and $productSearchKeyword != null)
                            @forelse($productSearchResult as $product)
                                <a href="#" class="dropdown-item" style="background:#fff" wire:click="fillProductToDebt({{$product->id}})">
                                    <h4 class="card-title mb-0">{{$product->name}} </h4>

                                    {{--Product Cost--}}
                                    <span class="d-block mb-0">{{$product->serial}}</span>
                                </a>
                                <div class="dropdown-divider"></div>
                            @empty
                                no
                            @endforelse
                        @endif
                    </div>
                </td>
                <td class="border text-center px-4 py-2">
                    <input type="text"
                           class="form-control"
                           wire:model.lazy="new_debt_name"
                           wire:keydown.enter="storeDebt('{{$debtor->id}}')"
                           wire:keydown.escape="closeCreateDebtComponent">
                    @error('new_debt_name') <h1 class="alert alert-danger">{{$message}}</h1>@enderror
                </td>
                <td class="border text-center px-4 py-2">
                    <input type="text"
                           class="form-control"
                           wire:model.lazy="new_debt_description"
                           wire:keydown.enter="storeDebt('{{$debtor->id}}')"
                           wire:keydown.escape="closeCreateDebtComponent">
                    @error('new_debt_description') <h1 class="alert alert-danger">{{$message}}</h1>@enderror
                </td>
                <td class="border text-center px-4 py-2">
                    <input type="number"
                           class="form-control"
                           wire:model.lazy="new_debt_amount"
                           wire:keydown.enter="storeDebt('{{$debtor->id}}')"
                           wire:keydown.escape="closeCreateDebtComponent">
                    @error('new_debt_amount') <h1 class="alert alert-danger">{{$message}}</h1>@enderror
                </td>
                <td class="border text-center px-4 py-2">
                    <input type="number"
                           class="form-control"
                           wire:model.lazy="new_debt_cost"
                           wire:keydown.enter="storeDebt('{{$debtor->id}}')"
                           wire:keydown.escape="closeCreateDebtComponent">
                    @error('new_debt_cost') <h1 class="alert alert-danger">{{$message}}</h1>@enderror
                </td>
                <td class="border text-center px-4 py-2">
                    <input type="number"
                           class="form-control"
                           wire:model.lazy="new_debt_price"
                           wire:keydown.enter="storeDebt('{{$debtor->id}}')"
                           wire:keydown.escape="closeCreateDebtComponent">
                    @error('new_debt_price') <h1 class="alert alert-danger">{{$message}}</h1>@enderror
                </td>
                <td class="border text-center px-4 py-2">
                    <input type="date"
                           class="form-control"
                           wire:model.lazy="new_debt_due"
                           wire:keydown.enter="storeDebt('{{$debtor->id}}')"
                           wire:keydown.escape="closeCreateDebtComponent">
                    @error('new_debt_due') <h1 class="alert alert-danger">{{$message}}</h1>@enderror
                </td>
                <td class="border text-center px-4 py-2">
                    <button class="btn-success btn-sm float-right"
                            wire:click="storeDebt('{{$debtor->id}}')">
                        <i class="fa fa-sign-in-alt fa-2x"></i>
                    </button>

                    <button class="btn-danger btn-sm float-right"
                            wire:click="closeCreateDebtComponent">
                        <i class="fa fa-window-close fa-2x"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>

</div>
