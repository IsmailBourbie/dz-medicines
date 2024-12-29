@component('layouts.base', ['title' => $medicine->label])
    <div class="min-h-screen flex items-center justify-center flex-col space-y-14">
        <section class="w-9/12 space-y-3">
            <div class="py-2">
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
                            class="flex gap-1 font-quicksand bg-purple-100 text-purple-700 text-xs font-bold me-2 px-1.5 py-0.5 rounded tracking-wide">
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
                        <h2 class="text-lg mr-2 font-bold text-sky-800">Speciality:</h2>
                        <span class="text-slate-500 font-medium">{{$medicine->speciality->name}}</span>
                    </div>
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
                            class="flex gap-1 font-quicksand bg-purple-100 text-purple-700 text-xs font-bold me-2 px-1.5 py-0.5 rounded tracking-wide"
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

        <section class="w-9/12 space-y-4">
            <h2
                class="font-quicksand font-medium text-2xl text-sky-800 relative after:absolute after:-z-10 after:left-0 after:top-1/2 after:w-full after:h-[2px] after:bg-sky-600 transform after:-translate-y-1/2"
            >
                <div class="bg-white pe-2 inline">
                    Explore related medicines
                </div>
            </h2>
            <ul class="divide-y divide-slate-200 px-4">
                @forelse($related_medicines as $related_medicine)
                    <li class="text-sky-700/80 font-medium pt-2 pb-1">
                        <a class="inline-flex items-center space-x-1 hover:text-sky-700 transition-colors"
                           href="{{$related_medicine->path()}}">
                            <span>{{$related_medicine->label}}</span>
                            <x-icons.arrow-top-right-on-square size="sm"/>
                        </a>
                    </li>
                @empty
                    <li class="text-sky-500 tracking-wide font-medium pt-2 pb-1">
                        – No related medicines.
                    </li>
                @endforelse
            </ul>
        </section>

        <section class="w-9/12 space-y-4">
            <h2
                class="font-quicksand font-medium text-2xl text-sky-800 relative after:absolute after:-z-10 after:left-0 after:top-1/2 after:w-full after:h-[2px] after:bg-sky-600 transform after:-translate-y-1/2"
            >
                <div class="bg-white pe-2 inline">
                    See more from <span class=" font-bold text-sky-600">{{$medicine->laboratory->name}}</span>
                </div>
            </h2>
            <ul class="divide-y divide-slate-200 px-4">
                @forelse($same_lab_medicines as $medicine)
                    <li class="text-sky-700/80 font-medium pt-2 pb-1">
                        <a class="inline-flex items-center space-x-1 hover:text-sky-700 transition-colors"
                           href="{{$medicine->path()}}">
                            <span>{{$medicine->label}}</span>
                            <x-icons.arrow-top-right-on-square size="sm"/>
                        </a>
                    </li>
                @empty
                    <li class="text-sky-500 tracking-wide font-medium pt-2 pb-1">
                        – No medicines from this lab.
                    </li>
                @endforelse
            </ul>
        </section>

    </div>
@endcomponent
