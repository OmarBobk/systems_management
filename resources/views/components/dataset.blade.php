@props(['table_data', 'is_edit', 'editable_type'])

{{--
        [
            'thead'             => [],
            'tbody'             => [],
            'td'                => [
                'Column' => is_editable?
            ],
            'details_table'     => '',
            'buttons'           => '',
            'is_details_table'  => false,
            'paginate'          => false
        ]
--}}
<div class="overflow-x-auto">


    {{--Start Main Table--}}
    <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative border">
        {{--Start Table Header--}}
        <thead>
        <tr class="text-center">
            @foreach($table_data['thead'] as $th)
                <th class="bg-gray-50 sticky top-0 border-b border-gray-100 px-2 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs truncate">
                    {{$th}}
                </th>
            @endforeach
        </tr>
        </thead>
        {{--End Table Header--}}


        {{--Start Table Body--}}
        <tbody class="text-center">
            @foreach($table_data['tbody'] as $item)
                <tr>
                    @foreach($table_data['td'] as $property => $is_editable)
                        @if($property != 'actions')
                            @if($is_editable)

                                @if(isset($is_edit[$property][$item->id]))
                                    @if( $is_edit[$property][$item->id] )
                                        <td class=" text-gray-600 px-2 py-3 border-t border-gray-100 whitespace-nowrap">
                                            <div class=" inline-block truncate">
                                                @if($editable_type[$property] != 'textarea')
                                                    <input type="{{$editable_type[$property]}}"
                                                           class=" w-full border-2 border-gray-300 bg-white h-10 w-40 !pl-4 rounded-lg text-sm
                                                               focus:outline-none focus:border-2 focus:border-gray-500 focus:ring-[none] focus:ring-0"
                                                           wire:model.lazy="{{ $property }}.{{ $item->id  }}"
                                                           wire:keydown.enter="updateNew('{{$item->id}}', '{{ $property }}')"
                                                           wire:keydown.escape="closeEdit('{{$item->id}}', '{{ $property }}')">
                                                @else
                                                    <textarea
                                                            cols="5"
                                                            rows="5"
                                                            class=" w-full border-2 border-gray-300 bg-white h-10 w-40 !pl-4 rounded-lg text-sm
                                                               focus:outline-none focus:border-2 focus:border-gray-500 focus:ring-[none] focus:ring-0"
                                                            wire:model.lazy="{{ $property }}.{{ $item->id  }}"></textarea>
                                                @endif
                                            </div>
                                            @error("$property.". $item->id ) <span class=" block mt-[0.5rem] text-red-500">{{ $message }}</span> @enderror
                                        </td>
                                    @else
                                        {{--Editable but !is_edit--}}
                                        <td class=" text-gray-600 px-2 py-3 border-t border-gray-100 whitespace-nowrap"
                                            wire:click="edit_field({{ $item->id }}, '{{ $property }}')">
                                            <div class=" inline-block truncate">{{ (isset($editable_type[$property]) ? ($editable_type[$property] == 'number' && $property != 'amount') ? number_format($item->{$property}/1000, 3) : $item->{$property} : $item->{$property}) }}</div>
                                        </td>
                                    @endif
                                @else
                                    {{--Editable but !is_edit--}}
                                    <td class=" text-gray-600 px-2 py-3 border-t border-gray-100 whitespace-nowrap"
                                        wire:click="edit_field({{ $item->id }}, '{{ $property }}')">
                                        <div class=" inline-block truncate">{{ (isset($editable_type[$property]) ? ($editable_type[$property] == 'number' && $property != 'amount') ? number_format($item->{$property}/1000, 3) : $item->{$property} : $item->{$property}) }}</div>
                                    </td>
                                @endif
                            @else
                                {{--Not Editable--}}
                                <td class=" text-gray-600 px-2 py-3 border-t border-gray-100 whitespace-nowrap">
                                    <div class=" inline-block truncate">{{ (isset($editable_type[$property]) ? ($editable_type[$property] == 'number' && $property != 'amount') ? number_format($item->{$property}/1000, 3) : $item->{$property} : $item->{$property}) }}</div>
                                </td>
                            @endif
                        @endif
                    @endforeach

                        {{--Actions--}}
                        <td class=" text-gray-600 px-2 py-3 border-t border-gray-100 whitespace-nowrap ">
                            @include($table_data['buttons'])
                        </td>


                </tr>

                {{--Details Table--}}
                @if($table_data['is_details_table'])
                    @include($table_data['details_table'])
                @endif

            @endforeach
        </tbody>
        {{--End Table Body--}}

    </table>
    {{--End Main Table--}}

    {{--Pagination--}}
    @if($table_data['paginate'])
        <div class="!mt-8">
            {{$table_data['tbody']->links()}}
        </div>
    @endif
</div>








