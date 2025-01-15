@component('layouts.base', ['title' => 'Meddz'])
    <header>
        <div class="">
            <nav class="py-10"></nav>
            <div
                class="py-20 bg-cover bg-bottom bg-[url('https://static.vecteezy.com/system/resources/previews/053/967/103/non_2x/abstract-blue-background-with-geometric-shapes-free-vector.jpg')] text-center text-white space-y-4 rounded-3xl">
                <h2 class="text-6xl font-quicksand font-bold">Available medicines in Algeria</h2>
                <p class="text-xl font-medium pb-4">Your trusted source of information for prescription drugs and
                    medications</p>
            </div>
        </div>
        <div class="min-h-44 w-5/12 py-6 px-6 mx-auto bg-white rounded-lg -mt-16 shadow-xl border border-slate-200">
            <form action="" class="space-y-10">
                <div class="flex">
                    <label for="search-input" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="flex items-center absolute inset-y-0 left-0 pl-2.5 pointer-events-none">
                            <x-icons.magnifying-glass class="fill-gray-500"/>
                        </div>
                        <input type="text" id="search-input"
                               class="block w-full bg-gray-50 text-gray-900 text-sm border border-gray-300 pl-10 p-3 rounded-lg"
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
    </header>
    <section class="mt-20">
        <div class="w-8/12 mx-auto">
            <div class="flex flex-wrap">
                <div class="w-1/4 p-4">
                    <img src="https://placehold.co/250" alt="image">
                </div>
                <div class="w-1/4 p-4">
                    <img src="https://placehold.co/250" alt="image">
                </div>
                <div class="w-1/4 p-4">
                    <img src="https://placehold.co/250" alt="image">
                </div>
                <div class="w-1/4 p-4">
                    <img src="https://placehold.co/250" alt="image">
                </div>
                <div class="w-1/4 p-4">
                    <img src="https://placehold.co/250" alt="image">
                </div>
                <div class="w-1/4 p-4">
                    <img src="https://placehold.co/250" alt="image">
                </div>
                <div class="w-1/4 p-4">
                    <img src="https://placehold.co/250" alt="image">
                </div>
                <div class="w-1/4 p-4">
                    <img src="https://placehold.co/250" alt="image">
                </div>
            </div>
            <div class="text-end px-4">
                <a href="#"
                   class="flex items-center justify-end font-medium text-blue-700 hover:mr-0.5 hover:gap-0.5 transition-all">
                    All medicine Classes
                    <x-icons.arrow-long-right class="fill-blue-700"/>
                </a>
            </div>
        </div>
    </section>

    <section class="my-28">
        <div
            class="py-16 space-y-16 text-indigo-600">
            {{--            <h2 class="text-4xl font-quicksand font-bold text-center">Meddz by the Numbers</h2>--}}
            <div
                class="flex justify-around items-center w-8/12 mx-auto">
                <div class="space-y-4">
                    <h4 class="text-7xl font-bold font-quicksand">+10k</h4>
                    <p
                        class="relative py-4 text-lg font-medium text-center before:w-20 before:h-1 before:bg-indigo-600 before:absolute before:top-2"
                    >
                        Medicines to explore.
                    </p>
                </div>
                <div class="space-y-4">
                    <h4 class="text-7xl font-bold font-quicksand">28</h4>
                    <p class="relative py-4 text-lg font-medium text-center before:w-20 before:h-1 before:bg-indigo-600 before:absolute before:top-2">
                        Medicine Classes</p>
                </div>
                <div class="space-y-4">
                    <h4 class="text-7xl font-bold font-quicksand">+100</h4>
                    <p class="relative py-4 text-lg font-medium text-center before:w-20 before:h-1 before:bg-indigo-600 before:absolute before:top-2">
                        Laboratories Available.</p>
                </div>
            </div>
        </div>
    </section>
@endcomponent
