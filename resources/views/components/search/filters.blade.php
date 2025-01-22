@props([
    'is_generic' => null,
    'is_local' => null
])
<div class="flex space-x-4">
    <div>
        <x-popover>
            <x-popover.button
                class="flex items-center gap-2 rounded-lg border pl-3 pr-2 py-2 text-gray-600 text-sm hover:bg-gray-50">
                <div>
                    @if($is_generic === true)
                        Generics
                    @elseif($is_generic === false)
                        Innovators
                    @else
                        All Types
                    @endif
                </div>
                <x-icons.chevron-down size="sm"/>
            </x-popover.button>
            <x-popover.panel class="border border-gray-100 shadow-xl z-10" position="bottom-end">
                <div class="flex flex-col divide-y divide-gray-100 min-w-64">
                    <x-popover.close>
                        <button
                            wire:click="$set('isGeneric', null)"
                            class="w-full flex items-center justify-between text-gray-800 px-3 py-2 gap-2 cursor-pointer hover:bg-gray-100"
                            type="button">
                            All Types
                        </button>
                    </x-popover.close>
                    <x-popover.close>
                        <button
                            wire:click="$set('isGeneric', true)"
                            class="w-full flex items-center justify-between text-gray-800 px-3 py-2 gap-2 cursor-pointer hover:bg-gray-100"
                            type="button">
                            Generics
                        </button>
                    </x-popover.close>
                    <x-popover.close>
                        <button
                            wire:click="$set('isGeneric', false)"
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
        <x-popover>
            <x-popover.button
                class="flex items-center gap-2 rounded-lg border pl-3 pr-2 py-2 text-gray-600 text-sm hover:bg-gray-50">
                <div>
                    @if($is_local === true)
                        Local
                    @elseif($is_local === false)
                        Foreign
                    @else
                        All Origins
                    @endif
                </div>
                <x-icons.chevron-down size="sm"/>
            </x-popover.button>
            <x-popover.panel class="border border-gray-100 shadow-xl z-10" position="bottom-end">
                <div class="flex flex-col divide-y divide-gray-100 min-w-64">
                    <x-popover.close>
                        <button
                            wire:click="$set('isLocal', null)"
                            class="w-full flex items-center justify-between text-gray-800 px-3 py-2 gap-2 cursor-pointer hover:bg-gray-100"
                            type="button">
                            All Origins
                        </button>
                    </x-popover.close>
                    <x-popover.close>
                        <button
                            wire:click="$set('isLocal', true)"
                            class="w-full flex items-center justify-between text-gray-800 px-3 py-2 gap-2 cursor-pointer hover:bg-gray-100"
                            type="button">
                            Local
                        </button>
                    </x-popover.close>
                    <x-popover.close>
                        <button
                            wire:click="$set('isLocal', false)"
                            class="w-full flex items-center justify-between text-gray-800 px-3 py-2 gap-2 cursor-pointer hover:bg-gray-100"
                            type="button">
                            Foreign
                        </button>
                    </x-popover.close>
                </div>
            </x-popover.panel>
        </x-popover>
    </div>
</div>
