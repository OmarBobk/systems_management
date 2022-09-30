{{--Parent With No Children--}}
@if($child_category->childrenCategories->isEmpty())
    <li>
        {{$child_category->name}}
        <div class="form-check-inline radio-primary mr-[3px]">
            <input type="radio" wire:model.defer="selected_parent_category.{{$child_category->id}}"
                   id="customRadioInline5" name="customRadioInline2">
            <label for="customRadioInline5"></label>
        </div>
    </li>
@endif

{{--Parent With Children--}}
@if($child_category->childrenCategories->isNotEmpty())
    <li>
        <span class="bobk-caret"><i class="fa fa-angle-right pr-[4px] text-[1.5rem]"></i>{{$child_category->name}}</span>
        <div class="form-check-inline radio-primary mr-[3px]">
            <input type="radio" wire:model.defer="selected_parent_category.{{$child_category->id}}"
                   +id="customRadioInline5" name="customRadioInline2">
            <label for="customRadioInline5"></label>
        </div>

        <ul class="bobk-nested">
            @foreach($child_category->categories as $childCategory)
                @include('livewire.backend.category.child-category', ['child_category' => $childCategory, 'spaces' => '  '])
            @endforeach
        </ul>
    </li>
@endif
