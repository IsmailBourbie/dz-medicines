@props([
    'is_generic',
    'is_local'
])
@php
    $type = match ($is_generic) {
        true => 'Generics',
        false => 'Innovators',
        default => 'All Types'
    };
    $origin = match ($is_local) {
        true => 'Local',
        false => 'Foreign',
        default => 'All Origins'
    };
@endphp
<div class="flex space-x-4">
    <div>
        <x-popover>
            <x-popover.button
                class="min-w-32 flex justify-between items-center gap-2 rounded-lg  border pl-3 pr-2 py-2 text-slate-600 text-sm hover:bg-gray-50">
                <div>
                    {{$type}}
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
                            @if($is_generic === null)
                                <x-icons.check/>
                            @endif

                        </button>
                    </x-popover.close>
                    <x-popover.close>
                        <button
                            wire:click="$set('isGeneric', true)"
                            class="w-full flex items-center justify-between text-gray-800 px-3 py-2 gap-2 cursor-pointer hover:bg-gray-100"
                            type="button">
                            Generics
                            @if($is_generic === true)
                                <x-icons.check/>
                            @endif
                        </button>
                    </x-popover.close>
                    <x-popover.close>
                        <button
                            wire:click="$set('isGeneric', false)"
                            class="w-full flex items-center justify-between text-gray-800 px-3 py-2 gap-2 cursor-pointer hover:bg-gray-100"
                            type="button">
                            Innovators
                            @if($is_generic === false)
                                <x-icons.check/>
                            @endif
                        </button>
                    </x-popover.close>
                </div>
            </x-popover.panel>
        </x-popover>
    </div>
    <div>
        <x-popover>
            <x-popover.button
                class="min-w-32 flex justify-between items-center gap-2 rounded-lg border pl-3 pr-2 py-2 text-gray-600 text-sm hover:bg-gray-50">
                <div>
                    {{$origin}}
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
                            @if($is_local === null)
                                <x-icons.check/>
                            @endif
                        </button>
                    </x-popover.close>
                    <x-popover.close>
                        <button
                            wire:click="$set('isLocal', true)"
                            class="w-full flex items-center justify-between text-gray-800 px-3 py-2 gap-2 cursor-pointer hover:bg-gray-100"
                            type="button">
                            Local
                            @if($is_local === true)
                                <x-icons.check/>
                            @endif
                        </button>
                    </x-popover.close>
                    <x-popover.close>
                        <button
                            wire:click="$set('isLocal', false)"
                            class="w-full flex items-center justify-between text-gray-800 px-3 py-2 gap-2 cursor-pointer hover:bg-gray-100"
                            type="button">
                            Foreign
                            @if($is_local === false)
                                <x-icons.check/>
                            @endif
                        </button>
                    </x-popover.close>
                </div>
            </x-popover.panel>
        </x-popover>
    </div>
</div>
