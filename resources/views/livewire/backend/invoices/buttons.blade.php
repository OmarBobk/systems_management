<div class="inline-flex items-center rounded-md shadow-sm">

    @if(isset($this->is_view_customer_actions[$item->id]))
        @if($this->is_view_customer_actions[$item->id])
            {{-- Update --}}
            <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border-y border-l
                                        rounded-l-lg border-slate-200 font-medium px-4 py-2 inline-flex space-x-1 items-center"
                    wire:click="updateNew('{{$item->id}}', '{{$this->edit_method_name}}')">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-500">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                        </svg>

                                    </span>
                <span class="hidden md:inline">Update</span>
            </button>

            {{--Close--}}
            <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200
                                        rounded-r-lg font-medium px-4 py-2 inline-flex space-x-1 items-center"
                    wire:click="closeEdit('{{$item->id}}', '{{$this->edit_method_name}}')">
                                    <span>
                                        <svg class="h-6 w-6 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </span>
                <span class="hidden md:inline">Close</span>
            </button>
        @else
            {{--Details Buttons--}}
            @include('livewire.backend.invoices.view_customer_details_buttons')
        @endif
    @else
        {{--Details Buttons--}}
        @include('livewire.backend.invoices.view_customer_details_buttons')
    @endif

</div>