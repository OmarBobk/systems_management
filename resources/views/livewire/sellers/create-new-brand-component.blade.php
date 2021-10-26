<div>
    <table class="table-fixed w-full">
        <thead>
        <tr class="bg-gray-100">
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Description</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                {{--Brand Name--}}
                <td class="border text-center px-4 py-2">
                    <input type="text"
                           class="form-control"
                           wire:model.lazy="new_brand_name"
                           wire:keydown.enter="storeBrand('{{$seller->id}}')"
                           wire:keydown.escape="closeCreateBrandComponent">
                    @error('new_brand_name') <h1 class="alert alert-danger">{{$message}}</h1>@enderror
                </td>

                {{--Brand Description--}}
                <td class="border text-center px-4 py-2">
                    <input type="text"
                           class="form-control"
                           wire:model.lazy="new_brand_description"
                           wire:keydown.enter="storeBrand('{{$seller->id}}')"
                           wire:keydown.escape="closeCreateBrandComponent">
                    @error('new_brand_description') <h1 class="alert alert-danger">{{$message}}</h1>@enderror
                </td>

                {{--Actions--}}
                <td class="border text-center px-4 py-2">
                    <button class="btn-success btn-sm float-right"
                            wire:click="storeBrand('{{$seller->id}}')">
                        <i class="fa fa-sign-in-alt fa-2x"></i>
                    </button>

                    <button class="btn-danger btn-sm float-right"
                            wire:click="closeCreateBrandComponent">
                        <i class="fa fa-window-close fa-2x"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>

</div>
