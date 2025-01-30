@props(['userName' => 'Default'])
<div>
    <x-popover>
        <x-popover.button
            class="min-w-32 cursor-pointer flex justify-end items-center pl-3 pr-2 py-2 text-gray-600 hover:text-gray-950 font-bold">
            <x-icons.user-circle size="lg"/>
            <div class="hidden md:block">
                {{$userName}}
            </div>
        </x-popover.button>
        <x-popover.panel class="border border-gray-100 shadow-xl z-10" position="bottom-end">
            <div class="flex flex-col divide-y divide-gray-100 min-w-64">
                <x-popover.close>
                    <button
                        class="w-full flex items-center justify-between text-gray-800 px-3 py-2 gap-2 cursor-pointer hover:bg-gray-100"
                        type="button">
                        Settings
                    </button>
                </x-popover.close>
                <x-popover.close>
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button type="submit"
                                class="w-full flex items-center justify-between text-gray-800 px-3 py-2 gap-2 cursor-pointer hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                </x-popover.close>
            </div>
        </x-popover.panel>
    </x-popover>
</div>
