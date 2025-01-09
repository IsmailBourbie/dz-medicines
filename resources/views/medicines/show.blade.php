@component('layouts.base', ['title' => $medicine->label])
    <div class="w-9/12 mx-auto">
        <div class="min-h-screen flex flex-col items-center justify-center space-y-14">
            <x-medicine.section class="py-5 capitalize">
                <div class="py-2">
                    <h2 class="text-5xl text-sky-700 font-quicksand font-bold tracking-wide mb-2">
                        {{$medicine->name}}
                    </h2>
                    <span
                        class="ps-1.5 text-xl text-sky-500 font-medium tracking-wider">{{$medicine->dci}}</span>
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
                            <span class="text-slate-500 font-medium uppercase">{{$medicine->packaging}}</span>
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
                            <h2 class="text-lg mr-2 font-bold text-sky-800">Class:</h2>
                            <a href="{{route('classes.show', $medicine->class)}}"
                               class="text-slate-500 font-medium"
                            >
                                {{$medicine->class->name}}
                            </a>
                        </div>
                        <div class="flex items-baseline">
                            <h2 class="text-lg mr-2 font-bold text-sky-800">Laboratory:</h2>
                            <a href="{{route('laboratories.show', $medicine->laboratory)}}"
                               class="text-slate-500 font-medium"
                            >
                                {{$medicine->laboratory->name}}
                            </a>
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
                                    <span>local</span>
                                    <x-icons.home size="sm"/>
                                @else
                                    <span class="">foreign</span>
                                    <x-icons.globe-americas size="sm"/>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </x-medicine.section>

            <x-medicine.section>
                <x-medicine.section.heading>
                    Available generic medicines
                </x-medicine.section.heading>
                <x-medicine.section.list :medicines="$generics"
                                         empty-state-display="No available generics."
                />
            </x-medicine.section>

            <x-medicine.section>
                <x-medicine.section.heading>
                    Explore
                    <a href="{{route('classes.show', $medicine->class)}}"
                       class=" font-bold text-sky-600 hover:text-sky-700"
                    >
                        related medicines
                    </a>
                </x-medicine.section.heading>
                <x-medicine.section.list :medicines="$classMedicines"
                                         empty-state-display="No related medicines."/>
            </x-medicine.section>

            <x-medicine.section>
                <x-medicine.section.heading>
                    See more from
                    <a href="{{route('laboratories.show', $medicine->laboratory)}}"
                       class=" font-bold text-sky-600 hover:text-sky-700"
                    >
                        {{$medicine->laboratory->name}}
                    </a>
                </x-medicine.section.heading>
                <x-medicine.section.list :medicines="$labMedicines"
                                         empty-state-display="No medicines from this lab."
                />
            </x-medicine.section>
        </div>
    </div>
@endcomponent
