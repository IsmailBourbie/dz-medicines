<div class="flex space-x-4">
    <div>
        <x-popover>
            <x-popover.button
                class="flex items-center gap-2 rounded-lg border pl-3 pr-2 py-1 text-gray-600 text-sm hover:bg-gray-50">
                <div>
                    @if(empty($type) || $type === 'all')
                        All Types
                    @elseif($type === 'generics')
                        Generics
                    @elseif($type === 'innovators')
                        Innovators
                    @endif
                </div>
                <x-icons.chevron-down size="sm"/>
            </x-popover.button>
            <x-popover.panel class="border border-gray-100 shadow-xl z-10" position="bottom-end">
                <div class="flex flex-col divide-y divide-gray-100 min-w-64">
                    <x-popover.close>
                        <button
                            wire:click="$set('type', 'all')"
                            class="w-full flex items-center justify-between text-gray-800 px-3 py-2 gap-2 cursor-pointer hover:bg-gray-100"
                            type="button">
                            All Types
                        </button>
                    </x-popover.close>
                    <x-popover.close>
                        <button
                            wire:click="$set('type', 'generics')"
                            class="w-full flex items-center justify-between text-gray-800 px-3 py-2 gap-2 cursor-pointer hover:bg-gray-100"
                            type="button">
                            Generics
                        </button>
                    </x-popover.close>
                    <x-popover.close>
                        <button
                            wire:click="$set('type', 'innovators')"
                            class="w-full flex items-center justify-between text-gray-800 px-3 py-2 gap-2 cursor-pointer hover:bg-gray-100"
                            type="button">
                            Innovators
                        </button>
                    </x-popover.close>
                </div>
            </x-popover.panel>
        </x-popover>
    </div>
    <div>
        <label for="types" class="sr-only">Select
            a type</label>
        <select id="types"
                wire:model.live="type"
                class="min-w-40 border-b border-slate-400 text-gray-900 text-sm block p-1.5">
            <option value="all" selected>All Types</option>
            <option value="generics">Generics</option>
            <option value="innovators">Innovators</option>
        </select>
    </div>
    <div>
        <label for="origins" class="sr-only">Select
            an origin</label>
        <select id="origins"
                wire:model.live="origin"
                class="min-w-40 border-b border-slate-400 text-gray-900 text-sm block p-1.5">
            <option value="all" selected>All Origin</option>
            <option value="local">Local</option>
            <option value="foreign">Foreign</option>
        </select>
    </div>
</div>
