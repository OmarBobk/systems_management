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
        @foreach($item->invoices as $invoice)
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
        @if(isset($this->is_view_invoice_details[$item->id.'-'.$invoice->id]))
            @if($this->is_view_invoice_details[$item->id.'-'.$invoice->id])
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
                <button class="ml-[83%] sm:ml-[84%] text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200
                    rounded-lg font-medium px-4 py-2 inline-flex space-x-1 items-center !mb-2"
                        wire:click="create_new_invoice">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                             class="w-6 h-6 text-green-500">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>

                    </span>

                    <span class="hidden md:inline">Create</span>
                </button>
            </td>
        </tr>
        </tbody>
    </table>
</div>