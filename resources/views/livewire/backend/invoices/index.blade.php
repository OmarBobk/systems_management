<div>


    <div class="w-full mx-auto max-w-[90%] !px-6 sm:!px-20 absolute
        bg-white top-[55%] sm:top-[75%] left-[5%] sm:left-[6%] ">

        @if(session()->has('message'))
            <div wire:ignore class="bg-teal-100  border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3 !-mt-8"
                 x-data="{ showSessionMessage: true }" x-show="showSessionMessage"
                 x-transition:enter="transition ease-out duration-2000"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="transform opacity-100 scale-100"
                 x-transition:leave-end="transform opacity-0 scale-95"
                 role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm alert alert-success {{session('alert')}}">{{session('message')}}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="text-left sm:text-center gap-4 sm:gap-20 !mt-12 flex">
            <div class="flex-1 px-3 py-2 w-1/3 bg-gray-100">Records: {{$this->all_records}}</div>
            <div class="flex-1 px-3 py-2 w-1/3 bg-gray-100">Profits: {{number_format($this->all_profits / 1000, 3)}}</div>
            <div class="flex-1 px-3 py-2 w-1/3 bg-gray-100">Costs: {{number_format($this->all_costs / 1000, 3)}}</div>
        </div>

        <div class="mt-12 max-w-lg sm:mx-auto md:max-w-none !mb-8">
            <div class="w-full mb-12 flex flex-wrap md:flex-nowrap gap-[.7rem] md:gap-8 justify-start md:justify-center items-center">

                <div class="flex flex-auto ">
                    <div class="relative text-gray-600 w-full ">
                        <input class=" w-full border-2 border-gray-300 bg-white h-10 !pl-4 !pr-12 rounded-lg text-sm
                               focus:outline-none focus:border-2 focus:border-gray-500 focus:ring-[none] focus:ring-0"
                               wire:model.debounce.500ms="searchKeyword"
                               type="search" name="search" placeholder="Search">
                        <button type="submit" class="absolute right-[3%] top-[34%]">
                            <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                                 viewBox="0 0 56.966 56.966"
                                 xml:space="preserve"
                                 width="512px" height="512px">
                            <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"/>
                        </svg>
                        </button>
                    </div>
                </div>

                <div class="flex-auto">
                    <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            wire:model="orderByColumn">
                        <option value="id">ID</option>
                        <option value="name">Name</option>
                        <option value="old">Oldest to Newest</option>
                        <option value="new">Newest to Oldest</option>
                    </select>
                </div>

                <div class="flex sm:flex-none flex-auto justify-end">

                    @if($this->is_create_new_customer)
                        <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200
                                rounded-lg font-medium px-4 py-2 inline-flex space-x-1 items-center"
                                wire:click="not_create_new_customer()">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>

                                </span>

                            <span class="hidden md:inline">Close</span>
                        </button>
                    @else
                        <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200
                                rounded-lg font-medium px-4 py-2 inline-flex space-x-1 items-center"
                                wire:click="create_new_customer()">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                     class="w-6 h-6 text-green-500">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>

                            </span>

                            <span class="hidden md:inline">Create</span>
                        </button>
                    @endif
                </div>

            </div>

            {{--Create New Customer--}}
            @if($this->is_create_new_customer)
                <div class="md:col-span-2 mb-[2rem] mt-[-1rem]">
                    <div class="overflow-hidden shadow sm:rounded-md">
                        <div class="bg-white px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <input type="text" name="create_customer_name" placeholder="Name" id="name"
                                           wire:model.lazy="create_customer_name"
                                           wire:keydown.enter="store_new_customer"
                                           wire:keydown.escape="not_create_new_customer"
                                           autocomplete="given-name"
                                           class=" w-full border-2 border-gray-300 bg-white h-10 !pl-4 !pr-12 rounded-lg text-sm focus:outline-none focus:border-2 focus:border-gray-500 focus:ring-[none] focus:ring-0">
                                    @error('create_customer_name') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <input type="text" name="create_customer_phone" placeholder="Phone"
                                           wire:model.lazy="create_customer_phone"
                                           wire:keydown.enter="store_new_customer"
                                           wire:keydown.escape="not_create_new_customer"
                                           id="phone" autocomplete="family-name"
                                           class=" w-full border-2 border-gray-300 bg-white h-10 !pl-4 !pr-12 rounded-lg text-sm focus:outline-none focus:border-2 focus:border-gray-500 focus:ring-[none] focus:ring-0">
                                    @error('create_customer_phone') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                            <button type="submit" wire:click="store_new_customer"
                                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            <x-dataset :table_data="$this->table_data"
                       :is_edit="$this->is_edit"
                       :editable_type="$this->editable_type"></x-dataset>
        </div>
    </div>
    <!-- component -->
    <style>
        dialog[open] {
            animation: appear .15s cubic-bezier(0, 1.8, 1, 1.8);
        }

        dialog::backdrop {
            background: linear-gradient(45deg, rgba(0, 0, 0, 0.5), rgba(54, 54, 54, 0.5));
            backdrop-filter: blur(3px);
        }


        @keyframes appear {
            from {
                opacity: 0;
                transform: translateX(-3rem);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>

    <dialog id="confirm_modal" wire:ignore class=" w-full my-[3rem] sm:w-1/4 p-5  bg-white rounded-md ">

        <div class="flex flex-col w-full h-auto ">
            <!-- Header -->
            <div class="flex w-full h-auto justify-center items-center">
                <div class="flex w-10/12 h-auto py-3 justify-center items-center text-2xl font-bold">
                    Delete Confirmation
                </div>
                <div onclick="document.getElementById('confirm_modal').close();" class="flex w-1/12 h-auto justify-center cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </div>
                <!--Header End-->
            </div>
            <!-- Modal Content-->
            <div class="flex w-full text-2xl h-auto py-10 px-2 justify-center items-center bg-gray-200 rounded text-center text-gray-500">
                Are You sure you want to delete this?
            </div>
            <!-- End of Modal Content-->

            <div class="flex justify-end mt-[1rem]">
                <button class="text-slate-800 !bg-red-500 hover:text-blue-600 text-sm hover:bg-slate-100 border border-slate-200
                        font-medium px-4 py-2 inline-flex space-x-1 items-center"
                        onclick="document.getElementById('confirm_modal').close();@this.delete_item()"
                    >
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                             class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                        </svg>
                    </span>
                    <span class="hidden md:inline">Delete</span>
                </button>
                @push('scripts')
                    <script>
                        window.livewire.on('showModalEvent', () => {

                            document.getElementById('confirm_modal').showModal()
                            console.log('show')

                        });
                    </script>
                @endpush
            </div>



        </div>
    </dialog>
</div>
