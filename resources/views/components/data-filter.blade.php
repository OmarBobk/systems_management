@props([
    'datepicker'    => false,
    'menu_data' => [],
])
@forelse($menu_data as $menu_variable => $menu)
    <div class="flex flex-row gap-[1rem] mr-[0rem] sm:mr-[1rem] justify-between">
        <div class="relative">
                <select
                        class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400
                        text-gray-700 py-[0.5rem] px-[1rem] pr-[2rem] leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        wire:model.lazy="{{$menu_variable}}"
                >
                    @forelse($menu as $option)
                        <option value="{{$option}}">{{$option}}</option>
                    @empty
                        No Items
                    @endforelse

                </select>
            <div
                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            </div>
        </div>
    </div>
@empty
@endforelse

@if($datepicker)
    <x-datepicker></x-datepicker>
@endif