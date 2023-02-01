{{--View Details & Delete Buttons--}}
@if(isset($is_view_invoice_details[$customer->id.'-'.$invoice->id]))
    @if($is_view_invoice_details[$customer->id.'-'.$invoice->id])
        {{--Close View Details Button --}}
        <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border-y border-l
                rounded-l-lg border-slate-200 font-medium px-4 py-2 inline-flex space-x-1 items-center"
                wire:click="view_invoice_details('{{$customer->id}}', '{{$invoice->id}}')">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor"
                         class="w-6 h-6 text-blue-400">
                      <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.5 15.75l7.5-7.5 7.5 7.5"/>
                    </svg>
                </span>
            <span class="hidden md:inline">Close</span>
        </button>

    @else
        {{--View Details Button --}}
        <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border-y border-l
                rounded-l-lg border-slate-200 font-medium px-4 py-2 inline-flex space-x-1 items-center"
                wire:click="view_invoice_details('{{$customer->id}}', '{{$invoice->id}}')">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6 text-blue-400">
                  <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                </svg>

            </span>
            <span class="hidden md:inline">View</span>
        </button>
    @endif
@else
    {{--View Details Button --}}
    <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border-y border-l
            rounded-l-lg border-slate-200 font-medium px-4 py-2 inline-flex space-x-1 items-center"
            wire:click="view_invoice_details('{{$customer->id}}', '{{$invoice->id}}')">
        <span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-6 h-6 text-blue-400">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
            </svg>

        </span>
        <span class="hidden md:inline">View</span>
    </button>

@endif
{{--Export Button --}}
<form target="_blank" action="{{route('backend.invoice_pdf', [$customer->id, $invoice->id])}}" method="POST">
    @csrf
{{--    <input type="hidden" value="{{$customer->id}}-{{$invoice->id}}" wire:model.lazy="invoices_pdf">--}}

        <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border-y border-l
                border-slate-200 font-medium px-4 py-2 inline-flex space-x-1 items-center"
                type="submit">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-slate-800">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                </svg>


            </span>
            <span class="hidden md:inline">PDF</span>
        </button>
</form>

{{--Delete--}}
<button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200
        rounded-r-lg font-medium px-4 py-2 inline-flex space-x-1 items-center"
        wire:click="what_to_delete({{$invoice->id}}, 'invoice')" id="btn"
>
    <span>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             class="w-6 h-6 text-red-500">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
        </svg>
    </span>
    <span class="hidden md:inline">Delete</span>
</button>
