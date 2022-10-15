{{--Parent With No Children--}}
@if($child_category->childrenCategories->isEmpty())
    <li>
        {{$child_category->name}}
    </li>
@endif

{{--Parent With Children--}}
@if($child_category->childrenCategories->isNotEmpty())
    <li>
        <span class="bobk-caret-treeview"><i class="fa fa-angle-right pr-[4px] text-[1.5rem]"></i>{{$child_category->name}}</span>

        <ul class="bobk-nested-treeview">
            @foreach($child_category->categories as $childCategory)
                @include('livewire.backend.category.child-categorytreeview', ['child_category' => $childCategory, 'spaces' => '  '])
            @endforeach
        </ul>
    </li>
@endif
