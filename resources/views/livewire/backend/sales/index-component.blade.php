<div>
    <div class="py-12">
        <div class="bg-white shadow-xl sm:rounded-lg px-4 py-4">
            @if(session()->has('message'))
                <div class="bg-teal-100  border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                     role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm alert alert-{{session('alert')}}">{{session('message')}}</p>
                        </div>
                    </div>
                </div>
            @endif

                <div class="row py-4">
                    <div class="col-4">
                        <div class="list-group-item" style="background:#f1f1f1">
                            Amount: {{$all_amounts}}
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="list-group-item" style="background:#f1f1f1">
                            Profits: {{number_format($all_profits/1000, 3)}} TL
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="list-group-item" style="background:#f1f1f1">
                            Cost: {{number_format($all_costs/1000, 3)}} TL
                        </div>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <x-datepicker></x-datepicker>

                <div>
                    <table class="table-fixed w-full">
                        <thead>
                        <tr class="bg-gray-100">
                            <th class="px-2 py-2 text-center w-20">No</th>
                            <th class="px-2 py-2 text-center">Code</th>
                            <th class="px-2 py-2 text-center">Description</th>
                            <th class="px-2 py-2 text-center">Amount</th>
                            <th class="px-2 py-2 text-center">Price</th>
                            <th class="px-2 py-2 text-center">Cost</th>
                            <th class="px-2 py-2 text-center">Total</th>
                            <th class="px-2 py-2 text-center">Profit</th>
                            <th class="px-2 py-2 text-center">Created At</th>
{{--                            <th class="px-4 py-2 text-center">Actions</th>--}}
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($sales as $sale)
                            <tr>
                                <td class="border text-center">{{$sale->id}}</td>
                                <td class="border text-center">
                                    @if($sale->saleable instanceof App\Models\Product) {{$sale->saleable->code}} @endif
                                    @if($sale->saleable instanceof App\Models\Invoice) {{$sale->saleable->invoicecustomer}} @endif
                                </td>
                                <td class="border px-2 py-2 text-center">{{$sale->description}}</td>
                                <td class="border text-center">{{$sale->amount}}</td>
                                <td class="border text-center">{{number_format($sale->net_price/1000, 3)}}</td>
                                <td class="border text-center">{{number_format($sale->cost/1000, 3)}}</td>
                                <td class="border text-center">{{number_format($sale->total/1000, 3)}}</td>
                                <td class="border text-center">{{number_format($sale->profit/1000, 3)}}</td>
                                <td class="border px-2 py-2 text-center">{{$sale->created_at}}</td>
{{--                                <td class="border px-4 py-2">--}}
{{--                                    <button class="btn btn-danger my-1"--}}
{{--                                            wire:click="delete('{{$sale->id}}')">Delete</button>--}}
{{--                                </td>--}}
                            </tr>
                        @empty
                        @endforelse

                        </tbody>
                    </table>
                    {{--                    {{$sales->links()}}--}}
                </div>

        </div>
    </div>
</div>
