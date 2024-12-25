@component('layouts.base', ['title' => $medicine->label])
    <div class="min-h-screen flex items-center justify-center">
        <section class="w-9/12">
            <div class="py-2 mb-8">
                <h2 class="text-5xl text-sky-700 font-quicksand font-bold tracking-wide">
                    {{$medicine->name}}
                </h2>
                <span class="text-xl text-sky-500 font-medium tracking-wider">{{$medicine->dci}}</span>
            </div>
            <div class="flex space-x-28">
                <div class="space-y-0.5">
                    <div class="flex items-baseline">
                        <h2 class="text-lg mr-2 font-bold text-sky-800">Dosage:</h2>
                        <span class="text-slate-500 font-medium">{{$medicine->dosage}}</span>
                    </div>
                    <div class="flex items-baseline">
                        <h2 class="text-lg mr-2 font-bold text-sky-800">Form:</h2>
                        <span class="text-slate-500 font-medium">{{$medicine->form}}</span>
                    </div>
                    <div class="flex items-baseline">
                        <h2 class="text-lg mr-2 font-bold text-sky-800">Packaging:</h2>
                        <span class="text-slate-500 font-medium">{{$medicine->packaging}}</span>
                    </div>
                    <div class="flex items-baseline">
                        <h2 class="text-lg mr-2 font-bold text-sky-800">Type:</h2>
                        <div
                            class="flex gap-1.5 font-quicksand bg-purple-100 text-purple-700 text-xs font-bold me-2 px-2.5 py-0.5 rounded">
                            @if($medicine->is_generic)
                                <span>Generic</span>
                                <x-icons.arrow-path size="sm"/>
                            @else
                                <span>Innovator</span>
                                <x-icons.check-badge size="sm"/>
                            @endif
                        </div>
                    </div>
                </div>
                <div>
                    <div class="flex items-baseline">
                        <h2 class="text-lg mr-2 font-bold text-sky-800">Laboratory:</h2>
                        <span class="text-slate-500 font-medium">{{$medicine->laboratory->name}}</span>
                    </div>
                    <div class="flex items-baseline">
                        <h2 class="text-lg mr-2 font-bold text-sky-800">Country:</h2>
                        <span class="text-slate-500 font-medium">{{$medicine->laboratory->country}}</span>
                    </div>
                    <div class="flex items-baseline">
                        <h2 class="text-lg mr-2 font-bold text-sky-800">Status:</h2>
                        <div
                            class="flex gap-2 font-quicksand bg-purple-100 text-purple-700 text-xs font-bold me-2 px-2.5 py-0.5 rounded"
                        >
                            @if($medicine->is_local)
                                <span>Local</span>
                                <x-icons.home size="sm"/>
                            @else
                                <span>Foreign</span>
                                <x-icons.globe-americas size="sm"/>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endcomponent
