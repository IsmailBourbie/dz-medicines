@component('layouts.base', ['title' => 'Import Data'])
    <x-wrapper>
        <x-form.wrapper class="md:w-4/12">
            <x-form.header>Import Medicines</x-form.header>
            <x-form action="{{route('admin.import-data.store')}}" method="POST" enctype="multipart/form-data">
                <div>
                    <x-fileUploader/>
                    @error('file')
                    <em class="text-xs font-bold tracking-wide text-red-600">{{$message}}</em>
                    @enderror
                </div>

                <div>
                    <button type="submit"
                            class="flex w-full justify-center rounded-md bg-blue-600 px-3 py-1.5 text-sm/6 font-semibold cursor-pointer text-white shadow-xs hover:bg-blue-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                        Import
                    </button>
                </div>
            </x-form>
        </x-form.wrapper>
    </x-wrapper>
@endcomponent
