<div class="p-[0.5rem]">
    <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative border">
        <thead>
        <tr class="text-center">
            <th class="bg-gray-50 sticky top-0 border-b border-gray-100 px-2 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs truncate">
                Serial
            </th>
            <th class="bg-gray-50 sticky top-0 border-b border-gray-100 px-2 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs truncate">
                Actions
            </th>
        </tr>
        </thead>
        <tbody class="text-center">
            <tr>
                <td class=" text-gray-600 px-2 py-3 border-t border-gray-100 whitespace-nowrap">
                    <div class=" truncate">
                        <input type="text" name="create_invoice_serial" placeholder="Serial" id="serial"
                               wire:model="create_invoice_serial"
                               wire:keydown.enter="store_new_invoice({{$customer->id}})"
                               wire:keydown.escape="not_create_new_invoice"
                               autocomplete="given-name"
                               class=" w-full border-2 border-gray-300 bg-white h-10 !pl-4 !pr-4 rounded-lg text-sm focus:outline-none focus:border-2 focus:border-gray-500 focus:ring-[none] focus:ring-0">
                        @error('create_invoice_serial') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                </td>
                {{--Actions--}}
                <td class=" text-gray-600 px-2 py-3 border-t border-gray-100 whitespace-nowrap w-1/4">
                    <div class="inline-flex items-center rounded-md shadow-sm">
                        <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border-y border-l
                            rounded-l-lg border-slate-200 font-medium px-4 py-2 inline-flex space-x-1 items-center"
                                wire:click="store_new_invoice({{$customer->id}})">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-500">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>


                        </span>
                            <span class="hidden md:inline">Save</span>
                        </button>

                        <button class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border-y border-l
                            rounded-r-lg border-slate-200 font-medium px-4 py-2 inline-flex space-x-1 items-center"
                                wire:click="not_create_new_invoice">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>


                        </span>
                            <span class="hidden md:inline">Close</span>
                        </button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
