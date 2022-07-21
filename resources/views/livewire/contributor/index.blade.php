<div>
    <div class="container-fluid mt--6">
        <div class="bg-white card overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

            <div class="flex ...">
                <div class=" w-4/12 h-14 ..."></div>

                {{--Contributor Name--}}
                <div class=" font-bold text-5xl text-center w-4/12 d-flex items-center justify-center">
                    {{$contributor->name}}
                </div>

                {{--Total Amount--}}
                <div class=" items-center justify-end  d-flex w-4/12">
                    <span class="badge badge-primary float-right text-lg">{{$this->original_amount}}</span>
                </div>
            </div>

            <div class="mt-4">
                <x-table
                    :striped="true"
                :columns='[
                            [
                                "name" => "Amount",
                                "field" => "amount",
                                "columnClasses" => "",
                                "rowClasses" => ""
                            ],
                            [
                                "name" => "Status",
                                "field" => "status",
                                "columnClasses" => "",
                                "rowClasses" => ""
                            ],
                        ]'
                :rows='$rows_data[$this->selected]'
                table-text-link-label="Type"
                custom-field-name="Contribution"
                :tabs='$this->tableTabs'
            >
                <x-slot name="customField">
                    <div class="inline-block truncate align-bottom">
                        <a href="#"
                           class="text-blue-500 underline"
                           x-text="row.contribution_id"></a>
                    </div>
                </x-slot>

{{--                <x-slot name="tableTextLink" >--}}
{{--                    <div class="flex space-x-3 items-center">--}}
{{--                        <div>--}}
{{--                            @if($this->selected == 'Costs' or $this->selected == 'Profits')--}}
{{--                                <a :href="`{{route('incomes')}}/${row.id}`"--}}
{{--                                   x-text="row.id"--}}
{{--                                   target="_blank"--}}
{{--                                   class="text-blue-500 underline"></a>--}}
{{--                            @elseif($this->selected == 'All')--}}
{{--                                <a :href="'https://bobk.test/' + (row.type === 'cost' || row.type === 'profit' ? 'incomes' : 'expenses') + '/' + row.id"--}}
{{--                                   x-text="row.id"--}}
{{--                                   target="_blank"--}}
{{--                                   class="text-blue-500 underline"></a>--}}
{{--                            @else--}}
{{--                                <a :href="`{{route('expenses')}}/${row.id}`"--}}
{{--                                   x-text="row.id"--}}
{{--                                   target="_blank"--}}
{{--                                   class="text-blue-500 underline"></a>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </x-slot>--}}

                <x-slot name="tableTextLink" >
                    <div class="flex space-x-3 items-center">
                        <div>
                            <button
                                x-on:click="$wire.toggleShowProfitsDetails(row.type, row.contribution_id)"
                                wire:click=""
                               x-text="row.type"
                               class="text-blue-500 underline"
                            ></button>

                        </div>
                    </div>
                </x-slot>

                <x-slot name="tableActions">
                    <div class="flex flex-wrap space-x-4">
                        <a :href="`avengers/${row.name}/show`" class="text-blue-500 underline">Edit</a>
                        <a :href="`avengers/${row.name}/delete`" class="text-red-500 underline">Delete</a>
                    </div>
                </x-slot>

                <x-slot name="showDetails">
                    @if(!empty($this->show_details))
                        @if($this->show_details[array_key_first($this->show_details)])
                            <div class="col-10">
                                <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative border">
                                    <thead>
                                    <tr class="text-center">
                                        <th class="bg-gray-50 sticky top-0 border-b border-gray-100 px-2 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs truncate">
                                            ID
                                        </th>
                                        <th class="bg-gray-50 sticky top-0 border-b border-gray-100 px-2 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs truncate">
                                            Type
                                        </th>
                                        <th class="bg-gray-50 sticky top-0 border-b border-gray-100 px-2 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs truncate">
                                            Amount
                                        </th>
                                        <th class="bg-gray-50 sticky top-0 border-b border-gray-100 px-2 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs truncate">
                                            {{$this->show_details_type == "Expenses" ? "Bill" : "Sale"}}
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    @foreach($this->get_records_details($this->show_details_contribution_id, $this->show_details_type) as $record)
                                    <tr>
                                        <td
                                            class="text-gray-600 px-2 py-3 border-t border-gray-100 whitespace-nowrap">
                                            <div class=" inline-block truncate">{{$record->id}}</div>
                                        </td>
                                        <td
                                            class="text-gray-600 px-2 py-3 border-t border-gray-100 whitespace-nowrap">
                                            <div class=" inline-block truncate">{{ucfirst($record->type)}}</div>
                                        </td>
                                        <td
                                            class="text-gray-600 px-2 py-3 border-t border-gray-100 whitespace-nowrap">
                                            <div class=" inline-block truncate">{{number_format($record->amount/1000, 3)}}</div>
                                        </td>
                                        <td
                                            class="text-gray-600 px-2 py-3 border-t border-gray-100 whitespace-nowrap">
                                            <div class=" inline-block truncate">
                                                <a href="#"
                                                   class="text-blue-500 underline">
                                                    {{$this->show_details_type == 'Expenses' ? $record->bill->serial : $record->sale_id}}
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    @endif
                </x-slot>

            </x-table>
            </div>



{{--            <div class="flex justify-center">--}}
{{--                <div id="chart" class="w-2/4 h-2/4"></div>--}}
{{--            </div>--}}

{{--            <script>--}}
{{--                document.addEventListener('alpine:init', () => {--}}

{{--                    var options = {--}}
{{--                        chart: {--}}
{{--                            type: 'line'--}}
{{--                        },--}}
{{--                        series: [{--}}
{{--                            name: 'sales',--}}
{{--                            data: [10, 9, 8.5, 11]--}}
{{--                        }],--}}
{{--                        xaxis: {--}}
{{--                            categories: ['01-11', '03-11', '05-11', '10-11']--}}
{{--                        }--}}
{{--                    }--}}

{{--                    var chart = new ApexCharts(document.querySelector("#chart"), options);--}}

{{--                    chart.render();--}}

{{--                })--}}
{{--            </script>--}}

        </div>
    </div>

</div>
