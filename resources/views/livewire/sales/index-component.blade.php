<div>
    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
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
                            Profits: {{$all_profits}} TL
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="list-group-item" style="background:#f1f1f1">
                            Cost: {{$all_costs}} TL
                        </div>
                    </div>
                </div>

            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No</th>
                        <th class="px-4 py-2">Product Code</th>
                        <th class="px-4 py-2">Description</th>
                        <th class="px-4 py-2">Amount</th>
                        <th class="px-4 py-2">Price</th>
                        <th class="px-4 py-2">Cost</th>
                        <th class="px-4 py-2">Total</th>
                        <th class="px-4 py-2">Profit</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($sales as $sale)
                        <tr>
                            <td class="border px-4 py-2">{{$sale->id}}</td>
                            <td class="border px-4 py-2">{{$sale->product->code}}</td>
                            <td class="border px-4 py-2">{{$sale->description}}</td>
                            <td class="border px-4 py-2">{{$sale->amount}}</td>
                            <td class="border px-4 py-2">{{$sale->net_price}}</td>
                            <td class="border px-4 py-2">{{$sale->cost}}</td>
                            <td class="border px-4 py-2">{{$sale->total}}</td>
                            <td class="border px-4 py-2">{{$sale->profit}}</td>
                            <td class="border px-4 py-2">
                                <button class="btn btn-primary my-1"
                                        wire:click="edit('{{$sale->id}}')">Edit</button>
                                <button class="btn btn-danger my-1"
                                        wire:click="delete('{{$sale->id}}')">Delete</button>
                            </td>
                        </tr>
                    @empty
                    @endforelse

                </tbody>
            </table>
                <div>
{{--                    {{$sales->links()}}--}}
                </div>

        </div>
    </div>
</div>
