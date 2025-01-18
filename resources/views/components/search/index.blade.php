<div
    {{$attributes->merge(['class' => 'min-h-44 py-6 px-6 bg-white rounded-lg  border border-slate-200'])}}>
    <form action="" class="space-y-10">
        <div class="flex">
            <label for="search-input" class="sr-only">Search</label>
            <div class="relative w-full">
                <div class="flex items-center absolute inset-y-0 left-0 pl-2.5 pointer-events-none">
                    <x-icons.magnifying-glass class="fill-gray-500"/>
                </div>
                <input type="text" id="search-input"
                       wire:model.live.debounce="query"
                       class="block w-full bg-gray-50/40 text-gray-900 text-sm border border-gray-300 pl-10 p-3 rounded-lg"
                       placeholder="Doliprane 500mg comp..." required="">
            </div>
        </div>
        <div class="flex items-center justify-between px-2">
            <div class="flex space-x-4">
                <div>
                    <label for="categories"
                           class="sr-only">Select
                        a category</label>
                    <select id="categories"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg block p-1.5">
                        <option value="0" selected>All Categories</option>
                        <option value="1">Medicines</option>
                        <option value="2">Dci</option>
                    </select>
                </div>
                <div>
                    <label for="types" class="sr-only">Select
                        a type</label>
                    <select id="types"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg block p-1.5">
                        <option value="0" selected>All Types</option>
                        <option value="1">Generics</option>
                        <option value="2">Innovators</option>
                    </select>
                </div>
                <div>
                    <label for="origins" class="sr-only">Select
                        an origin</label>
                    <select id="origins"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg block p-1.5">
                        <option value="0" selected>All Origin</option>
                        <option value="1">Foreign</option>
                        <option value="2">Local</option>
                    </select>
                </div>
            </div>
            <div>
                <button type="submit"
                        class="min-w-28 text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-4 py-2">
                    Search
                </button>
            </div>
        </div>
    </form>
</div>
