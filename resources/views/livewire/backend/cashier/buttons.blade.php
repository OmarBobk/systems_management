<div class="inline-flex items-center justify-center flex-wrap gap-[0.3rem]">
    @if(isset($this->is_view_product_actions[$item->id]))
        @if($this->is_view_product_actions[$item->id])
            {{-- Update --}}
            <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border-y border-x
                    rounded-lg border-slate-200 font-medium px-4 py-2 inline-flex space-x-1 items-center"
                    wire:click="updateNew('{{$item->id}}', '{{$this->edit_method_name}}')">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-500">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>

                </span>
                <span class="hidden xl:inline">Update</span>
            </button>

            {{--Close--}}
            <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border-y border-x
                    rounded-lg border-slate-200 font-medium px-4 py-2 inline-flex space-x-1 items-center flex-1"
                    wire:click="closeEdit('{{$item->id}}', '{{$this->edit_method_name}}')">
                    <span>
                        <svg class="h-6 w-6 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </span>
                <span class="hidden xl:inline">Close</span>
            </button>
        @else
            {{--Delete Button--}}
            <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200
                    rounded-lg font-medium px-4 py-2 inline-flex space-x-1 items-center"
                    wire:click="removeItemFromCart('{{$item->id}}')">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                         class="w-6 h-6 text-red-500">
                      <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                    </svg>
                </span>
                <span class="hidden xl:inline">Delete</span>
            </button>

        @endif
    @else
        {{--Delete Button--}}
        <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200
                rounded-lg font-medium px-4 py-2 inline-flex space-x-1 items-center"
                wire:click="removeItemFromCart('{{$item->id}}')">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                     class="w-6 h-6 text-red-500">
                  <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                </svg>
            </span>
            <span class="hidden xl:inline">Delete</span>
        </button>
    @endif
</div>