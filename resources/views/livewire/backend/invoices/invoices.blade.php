<div>
    <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative border">
        <thead>
        <tr class="text-center">
            <th class="bg-gray-50 sticky top-0 border-b border-gray-100 px-2 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs truncate">
                Serial
            </th>
            <th class="bg-gray-50 sticky top-0 border-b border-gray-100 px-2 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs truncate">
                Amount
            </th>
            <th class="bg-gray-50 sticky top-0 border-b border-gray-100 px-2 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs truncate">
                Price
            </th>
            <th class="bg-gray-50 sticky top-0 border-b border-gray-100 px-2 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs truncate">
                Profit
            </th>
            <th class="bg-gray-50 sticky top-0 border-b border-gray-100 px-2 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs truncate">
                Date
            </th>
            <th class="bg-gray-50 sticky top-0 border-b border-gray-100 px-2 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs truncate">
                Actions
            </th>
        </tr>
        </thead>
        <tbody class="text-center">
        @foreach($customer->invoices as $invoice)
            <tr>
                <td class=" text-gray-600 px-2 py-3 border-t border-gray-100 whitespace-nowrap">
                    <div class=" inline-block truncate">{{$invoice->serial}}</div>
                </td>
                <td class=" text-gray-600 px-2 py-3 border-t border-gray-100 whitespace-nowrap">
                    <div class=" inline-block truncate">{{$invoice->amount}}</div>
                </td>
                <td class=" text-gray-600 px-2 py-3 border-t border-gray-100 whitespace-nowrap">
                    <div class=" inline-block truncate">{{number_format($invoice->price / 1000, 3)}}</div>
                </td>
                <td class=" text-gray-600 px-2 py-3 border-t border-gray-100 whitespace-nowrap">
                    <div class=" inline-block truncate">{{number_format($invoice->profit / 1000, 3)}}</div>
                </td>
                <td class=" text-gray-600 px-2 py-3 border-t border-gray-100 whitespace-nowrap">
                    <div class=" inline-block truncate">{{\Carbon\Carbon::parse($invoice->created_at)->format('Y-m-d')}}</div>
                </td>
                {{--Actions--}}
                <td class=" text-gray-600 px-2 py-3 border-t border-gray-100 whitespace-nowrap w-1/4">
                    <div class="inline-flex items-center rounded-md shadow-sm">
                        {{--Details Buttons--}}
                        @include('livewire.backend.invoices.view_invoice_details_buttons')
                    </div>
                </td>
            </tr>
        {{--Records Table--}}
        @if(isset($is_view_invoice_details[$customer->id.'-'.$invoice->id]))
            @if($is_view_invoice_details[$customer->id.'-'.$invoice->id])
                <tr>
                    <td colspan="6" class=" text-gray-600 !px-2 sm:!px-10 py-3 border-t border-gray-100 whitespace-nowrap">
                        @include('livewire.backend.invoices.records')
                    </td>
                </tr>
            @endif
        @endif
        @endforeach
        @if($this->is_create_new_invoice)
            <tr>
                <td colspan="6" class="pt-[.5rem]">
                    @include('livewire.backend.invoices.create_new_invoice')
                </td>
            </tr>
        @endif
        <tr>
            <td colspan="6" class="pt-[.5rem]">
                @if($this->is_create_new_customer)
                    <button class="ml-[83%] sm:ml-[84%] block uppercase  shadow bg-danger  focus:shadow-outline focus:outline-none text-white text-xs !py-3 px-10 rounded"
                            wire:click="not_create_new_invoice">
                        Close
                    </button>
                @else
                    <button class="ml-[83%] sm:ml-[84%] text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200
                        rounded-lg font-medium px-4 py-2 inline-flex space-x-1 items-center !mb-2"
                            wire:click="create_new_invoice">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-500">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </span>
                        <span class="hidden md:inline">Create</span>
                    </button>
                @endif
            </td>
        </tr>
        </tbody>
    </table>
</div>