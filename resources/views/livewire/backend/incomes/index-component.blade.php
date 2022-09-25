<div>
    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            {{-- Incomes --}}
            <div>
                <table class="table-fixed w-full">
                    <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No</th>
                        <th class="px-4 py-2">Type</th>
                        <th class="px-4 py-2">Amount</th>
                        <th class="px-4 py-2">Contributor</th>
                        <th class="px-4 py-2">By</th>
                        <th class="px-4 py-2">Sale</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($incomes) and $incomes != null)
                        @forelse($incomes as $income)
                            <tr>
                                <td class="border px-4 py-2">{{$income->id}}</td>

                                {{--Income Type--}}
                                <td class="border px-4 py-2">
                                    {{$income->type}}
                                </td>

                                {{--Amount--}}
                                <td class="border px-4 py-2">
                                    {{number_format($income->amount/1000, 3)}}
                                </td>

                                {{--Contribution Id--}}
                                <td class="border px-4 py-2">
                                    {{$income->contribution->contributor->name}}
                                </td>

                                {{--User--}}
                                <td class="border px-4 py-2">
                                    {{$income->user->name}}
                                </td>

                                {{--Sale--}}
                                <td class="border px-4 py-2">
                                    <a href="#">{{$income->sale->id}}</a>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="10" class="border text-center px-4 py-2">You don't have any Incomes yet!!.</td>
                            </tr>
                        @endforelse
                    @else
                        <tr>
                            <td colspan="10" class="border text-center px-4 py-2">You don't have any Incomes yet!!.</td>
                        </tr>
                    @endif

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
