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
                    <span class="badge badge-primary float-right text-lg">10.000 TL</span>
                </div>
            </div>

            <div class="mt-4">

                <div>
                    Income Records:
                    <div class="flex min-h-screen w-full items-center justify-center">
                        <div x-data="{ filters: ['Costs', 'Profits', 'Expenses'], selected: 'Costs' }"
                             class="inline-flex rounded-lg my-3 bg-gray-100 bg-opacity-30 mx-auto">
                            <template x-for="(filter, index) in filters">
                                <div>
                                    <button @click="selected = filter"
                                            :class="[
                                        (index === filters.length -1) && '!rounded-r-lg',
                                        (index === 0) && '!rounded-l-lg',
                                         filter === selected && 'border-green-500 bg-green-500 text-white',
                                         (filter !== selected) && 'bg-red-500 bg-white'
                                         ]"
                                            class="py-2 sm:py-2 my-1 px-4 sm:px-6 inline-flex items-center justify-center font-medium border border-gray-50 text-center focus:bg-primary text-black text-sm sm:text-base capitalize focus:outline-none"
                                            x-text="filter">
                                    </button>
                                    <div x-if="(selected === 'Costs' && filter === 'Costs')">All</div>
                                    <div x-show="(selected === 'Profits' && filter === 'Profits')">Free</div>
                                    <div x-show="(selected === 'Expenses' && filter === 'Expenses')">Premium</div>
                                </div>
                            </template>
                        </div>
                    </div>

                </div>

                <x-table
                    :striped="true"
                :columns='[
			[
				"name" => "Type",
				"field" => "type",
				"columnClasses" => "",
				"rowClasses" => ""
			],
			[
				"name" => "Amount",
				"field" => "amount",
				"columnClasses" => "",
				"rowClasses" => ""
			],
			[
				"name" => "Created At",
				"field" => "created_at",
				"columnClasses" => "",
				"rowClasses" => ""
			]
		]'
                :rows='$this->incomes ?? []'
                table-text-link-label="ID"
            >
                <x-slot name="tableTextLink">
                    <div class="flex space-x-3 items-center">
                        <div>
                            <a :href="`{{route('incomes')}}/${row.id}`" x-text="row.id" class="text-blue-500 underline"></a>
                        </div>
                    </div>
                </x-slot>

                <x-slot name="tableActions">
                    <div class="flex flex-wrap space-x-4">
                        <a :href="`avengers/${row.name}/show`" class="text-blue-500 underline">Edit</a>
                        <a :href="`avengers/${row.name}/delete`" class="text-red-500 underline">Delete</a>
                    </div>
                </x-slot>

            </x-table>
            </div>


            <div class="flex justify-center">
                <div id="chart" class="w-2/4 h-2/4"></div>
            </div>

            <script>
                document.addEventListener('alpine:init', () => {

                    var options = {
                        chart: {
                            type: 'line'
                        },
                        series: [{
                            name: 'sales',
                            data: [10, 9, 8.5, 11]
                        }],
                        xaxis: {
                            categories: ['01-11', '03-11', '05-11', '10-11']
                        }
                    }

                    var chart = new ApexCharts(document.querySelector("#chart"), options);

                    chart.render();

                })
            </script>

        </div>
    </div>


</div>
