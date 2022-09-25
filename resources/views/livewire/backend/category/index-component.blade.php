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
                New Product
            </button>

            @if($isModalOpen)
                @include('livewire.category.create-component')
            @endif

            <table class="table-fixed w-full">
                <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 w-20">No</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Products</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
                </thead>
                <tbody>

                @forelse($categories as $category)
                    <tr>
                        <td class="border px-4 py-2">{{$category->id}}</td>
                        <td class="border px-4 py-2">{{$category->name}}</td>
                        <td class="border px-4 py-2">{{$category->products()->count()}}</td>
                        <td class="border px-4 py-2">
                            <button class="btn btn-primary my-1"
                                    wire:click="edit('{{$category->id}}')">Edit</button>
                            <button class="btn btn-danger my-1"
                                    wire:click="delete('{{$category->id}}')">Delete</button>
                        </td>
                    </tr>
                @empty
                @endforelse

                </tbody>
            </table>
            <div>
                {{$categories->links()}}
            </div>

        </div>
    </div>
</div>
