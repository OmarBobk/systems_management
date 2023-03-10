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
                New Category
            </button>

            @if($isModalOpen)
                @include('livewire.backend.category.create-component', ['parent_categories' => $parent_categories])
            @endif
                <div class="card m-b-30">
                    <div class="card-header border-none pb-0">
                        <h5 class="card-title ">Categories Tree View</h5>
                    </div>
                    @push('styles')
                            <style>
                                /* Remove default bullets */
                                ul, #bobk-myUL-treeview {
                                    list-style-type: none;
                                }

                                /* Remove margins and padding from the parent ul */
                                #bobk-myUL-treeview {
                                    margin: 0 !important;
                                    padding: 0 !important;
                                }

                                /* Style the caret/arrow */
                                .bobk-caret-treeview {
                                    cursor: pointer;
                                    user-select: none; /* Prevent text selection */
                                }

                                /* Hide the nested list */
                                .bobk-nested-treeview {
                                    display: none;
                                    padding-left: 40px !important;
                                }

                                /* Show the bobk-nested-treeview list when the user clicks on the bobk-caret-treeview/arrow (with JavaScript) */
                                .bobk-active-treeview {
                                    display: block;
                                }
                            </style>
                    @endpush
                    @push('scripts')
                            <script>
                                var toggler = document.getElementsByClassName("bobk-caret-treeview");
                                var i;

                                for (i = 0; i < toggler.length; i++) {
                                    toggler[i].addEventListener("click", function() {
                                        this.parentElement.querySelector(".bobk-nested-treeview")
                                            .classList.toggle("bobk-active-treeview");
                                        // this.classList.toggle("fa fa-angle-down");
                                        if(this.firstElementChild.classList.contains('fa-angle-right')) {
                                            this.firstElementChild.classList.remove('fa-angle-right')
                                            this.firstElementChild.classList.add('fa-angle-down')
                                        } else {
                                            this.firstElementChild.classList.remove('fa-angle-down')
                                            this.firstElementChild.classList.add('fa-angle-right')
                                        }
                                    });
                                }
                            </script>
                    @endpush
                    <div class="card-body !pt-0">
                        <ul id="bobk-myUL-treeview">
                            <li>
                                <span class="bobk-caret-treeview"><i class="fa fa-angle-right pr-[4px] text-[1.5rem]"></i>Categories</span>

                                <ul class="bobk-nested-treeview">
                                    <li>
                                        No Parent
                                    </li>
                                    @foreach($parent_categories as $category)

                                        {{-- Parent With no Children--}}
                                        @if($category->childrenCategories->isEmpty())
                                            <li>
                                                {{$category->name}}
                                            </li>
                                        @endif

                                        {{--Parent With Children--}}
                                        @if($category->childrenCategories->isNotEmpty())
                                            <li>
                                                <span class="bobk-caret-treeview"><i class="fa fa-angle-right pr-[4px] text-[1.5rem]"></i>{{$category->name}}</span>
                                                <ul class="bobk-nested-treeview">
                                                    @foreach ($category->childrenCategories as $childCategory)
                                                        @include('livewire.backend.category.child-categorytreeview', ['child_category' => $childCategory])
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

            <table class="table-fixed w-full">
                <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 w-20">No</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Products</th>
                    <th class="px-4 py-2">Parent</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
                </thead>
                <tbody>

                @forelse($all_categories as $category)
                    <tr>
                        <td class="border px-4 py-2">{{$category->id}}</td>
                        <td class="border px-4 py-2">{{$category->name}}</td>
                        <td class="border px-4 py-2">{{$category->products()->count()}}</td>
                        <td class="border px-4 py-2">{{$category->parent->name ?? 'Null'}}</td>
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
                {{$all_categories->links()}}
            </div>

        </div>
    </div>
</div>
