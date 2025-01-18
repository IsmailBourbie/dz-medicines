<div {{$attributes->merge(['class' =>"flex"])}}>
    <label for="search-input" class="sr-only">Search</label>
    <div class="relative w-full">
        <div class="flex items-center absolute inset-y-0 left-0 pl-2.5 pointer-events-none">
            <x-icons.magnifying-glass class="fill-gray-500"/>
        </div>
        <input type="text" id="search-input"
               wire:model.live.debounce="query"
               name="query"
               class="block w-full bg-gray-50/40 text-gray-900 text-sm border border-gray-300 pl-10 p-3 rounded-lg"
               placeholder="Doliprane 500mg comp..." required="">
    </div>
</div>
