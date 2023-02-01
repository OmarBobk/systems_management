{{--View Details & Delete Buttons--}}
@if(isset($is_view_customer_details[$customer->id]))
    @if($is_view_customer_details[$customer->id])
        {{--Close View Details Button --}}
        <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border-y border-l
                rounded-l-lg border-slate-200 font-medium px-4 py-2 inline-flex space-x-1 items-center"
                wire:click="view_customer_details('{{$customer->id}}')">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-400">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                    </svg>
                </span>
            <span class="hidden md:inline">Close</span>
        </button>

    @else
        {{--View Details Button --}}
        <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border-y border-l
                rounded-l-lg border-slate-200 font-medium px-4 py-2 inline-flex space-x-1 items-center"
                wire:click="view_customer_details('{{$customer->id}}')">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-400">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>

                </span>
            <span class="hidden md:inline">View</span>
        </button>
    @endif
@else
    {{--View Details Button --}}
    <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border-y border-l
            rounded-l-lg border-slate-200 font-medium px-4 py-2 inline-flex space-x-1 items-center"
            wire:click="view_customer_details('{{$customer->id}}')">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-400">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>

            </span>
        <span class="hidden md:inline">View</span>
    </button>
@endif