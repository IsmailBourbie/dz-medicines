@component('layouts.base', ['title' => 'Meddz'])
    <header>
        <div class="">
            <nav class="py-10"></nav>
            <div
                class="bg-gradient-to-b from-indigo-100 via-indigo-50 to-white">
                <div class="py-20 w-4/6 mx-auto text-center space-y-6">
                    <h2 class="text-6xl font-bold font-quicksand text-blue-950">
                        Access Reliable Information on Prescription Drugs and Medicines in Algeria
                    </h2>
                    <div class="space-y-12">
                        <p class="text-xl text-slate-600 font-medium pb-4 w-9/12 mx-auto">
                            Search and explore a comprehensive list of prescription drugs and medicines available in
                            Algeria, with accurate, up-to-date information to meet your healthcare needs.
                        </p>
                        <a href="{{route('medicines.index')}}"
                           class="inline-block px-6 py-3 text-lg text-blue-50 font-medium tracking-wider rounded-lg bg-blue-700 hover:bg-blue-800">
                            Discover Available Medicines
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <x-wrapper class="container mx-auto mt-20">
        <div class="w-8/12 mx-auto">
            <div class="flex flex-wrap -mx-2">
                @foreach($medicineClasses as $class)
                    <div class="relative w-1/4 px-2 mb-4 group">
                        <a href="{{route('classes.show', $class->id)}}">
                            <div class="overflow-hidden">
                                <img src="{{asset('images/classes/'.$class->id.'.webp')}}" alt="{{$class->name}}"
                                     loading="lazy"
                                     class="w-full h-auto group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="pb-4 pt-2 flex items-start justify-between">
                                <h3 class="text-sm text-blue-950 font-bold font-quicksand">{{$class->name}}</h3>
                                <x-icons.arrow-top-right-on-square size="sm"
                                                                   class="opacity-0 group-hover:opacity-100 transition-opacity duration-300"/>
                            </div>

                        </a>
                    </div>
                @endforeach
            </div>
            <div class="text-end px-4">
                <a href="#"
                   class="inline-flex items-center justify-end font-medium text-blue-700 hover:mr-0.5 hover:gap-0.5 transition-all">
                    All medicine Classes
                    <x-icons.arrow-long-right class="fill-blue-700"/>
                </a>
            </div>
        </div>
    </x-wrapper>

    <x-wrapper class="container mx-auto my-28 bg-slate-100">
        <div class="py-16 space-y-16">
            <div class="flex justify-around items-center px-8">
                <div class="w-7/12 space-y-4">
                    <h2 class="text-4xl font-quicksand font-bold text-blue-950">
                        Explore Medicines in Algeria with Meddz: Your Ultimate Guide to Insights and Details
                    </h2>
                    <p class="text-lg font-medium text-slate-600">
                        Dive into the comprehensive world of medicines available in Algeria with Meddz. Our statistics
                        section offers a wealth of information designed to empower you with accurate and reliable data.
                        From exploring a full list of available medications to uncovering detailed information about
                        their uses, origins, and manufacturers, we have it all. You can also discover generic
                        alternatives, explore various medicine classes, and make informed decisions about your
                        healthcare needs. Navigate with ease and unlock the knowledge you need—all in one place!
                    </p>
                </div>
                <div class="flex flex-col text-blue-500 space-y-3">
                    <div class="space-y-2">
                        <h4 class="text-4xl font-bold font-quicksand">9,000+</h4>
                        <p
                            class="relative py-4 font-medium before:w-20 before:h-1 before:bg-blue-500 before:absolute before:top-2"
                        >
                            Medicines to explore.
                        </p>
                    </div>
                    <div class="space-y-2">
                        <h4 class="text-4xl font-bold font-quicksand">28</h4>
                        <p class="relative py-4 font-medium before:w-20 before:h-1 before:bg-blue-500 before:absolute before:top-2">
                            Medicine Classes</p>
                    </div>
                    <div class="space-y-2">
                        <h4 class="text-4xl font-bold font-quicksand">100+</h4>
                        <p class="relative py-4 font-medium before:w-20 before:h-1 before:bg-blue-500 before:absolute before:top-2">
                            Laboratories Available.</p>
                    </div>
                </div>
            </div>
        </div>
    </x-wrapper>

    <x-wrapper class="container mx-auto space-y-4 mb-20">
        <div class="space-x-8 space-y-8">
            <div class="space-y-4 text-center">
                <h2 class="text-4xl text-blue-800 font-bold font-quicksand">
                    Discover Algeria's Pharmaceutical Laboratories
                </h2>
                <p class="w-8/12 mx-auto text-lg tracking-wide font-medium text-slate-500">
                    Browse an extensive list of laboratories revolutionizing healthcare in Algeria. Uncover their
                    innovations, product lines, and global impact—all in one place.
                    <a href="#"
                       class="inline-block mt-2 text-blue-600 font-semibold hover:text-blue-800 hover:underline focus:outline-hidden focus:ring-2 focus:ring-blue-500 transition">Learn
                        more</a>
                    to explore all available laboratories.
                </p>
            </div>
            <div class="text-center space-y-8">
                <img src="https://merinal.com/wp-content/uploads/2024/02/Export.svg" alt="global">
            </div>
        </div>
    </x-wrapper>

    <footer class="min-h-96 bg-slate-900 text-slate-100">
        <div class="w-7/12 mx-auto">
            <div class="flex items-center justify-between py-28">
                <h2 class="text-5xl font-bold font-quicksand">
                    Curious about being <br> part of
                    <span class="bg-indigo-300 text-indigo-950 rounded-lg inline-block mt-2">Meddz?</span>
                </h2>
                <div class="flex gap-2">
                    <button
                        class="px-8 py-4 min-w-44 font-bold tracking-wide bg-indigo-50 text-indigo-950 rounded-lg hover:bg-indigo-200">
                        Contribute
                        <x-icons.arrow-long-right size="base" class="inline"/>
                    </button>
                    <button
                        class="px-8 py-4 min-w-44 font-bold tracking-wide border border-indigo-100 rounded-lg hover:opacity-80">
                        Message me
                    </button>
                </div>
            </div>
            <div class="py-3 border-t border-slate-50/20 flex items-center justify-between">
                <div class="text-sm text-slate-400">
                    Meddz &copy; 2024 | Developed by <a href="https://ismailbourbie.com/" class="underline">Ismailbourbie</a>.
                </div>
                <ul class="flex gap-6 text-sm text-slate-400">
                    <li><a href="#">Api</a></li>
                    <li><a href="#">Terms of service</a></li>
                    <li><a href="#">Privacy policy</a></li>
                </ul>
            </div>
        </div>
    </footer>
@endcomponent
