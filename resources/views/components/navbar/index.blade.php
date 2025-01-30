@props(['user'])
<nav x-data="{ isScrolled: false, open: false }"
     @scroll.window="isScrolled = window.scrollY > 50"
     :class="{'bg-white shadow': isScrolled, 'bg-transparent': !isScrolled }"
     class="fixed w-full z-20 top-0 start-0 transition-all duration-300">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4 mb">
        <a href="{{route('welcome')}}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{asset('images/logo.svg')}}" class="h-6" alt="Meedz Logo">
        </a>
        <div class="flex items-center md:order-2 md:space-x-0">
            @if($user)
                <x-navbar.profile-menu userName="{{$user->name}}"/>
            @else
                <a href="{{route('login')}}" type="button"
                   class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm mr-2 px-4 py-2 text-center">
                    Get started
                </a>
            @endif
            <button x-on:click="open = !open" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    :class="{'bg-white': open}"
                    aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>

                <x-icons.bars-3/>
            </button>
        </div>
        <div class="items-center justify-between w-full md:flex md:w-auto md:order-1"
             :class="open ? 'flex' : 'hidden'"
             x-cloak
        >
            <ul class="flex flex-col w-full p-4 md:p-0 mt-4 font-medium border border-slate-200 bg-slate-100 md:bg-transparent rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
                <li>
                    <x-navbar.link label="Home" route="welcome"/>
                </li>
                <li>
                    <x-navbar.link label="Medicines" route="medicines.index"/>
                </li>
                <li>
                    <x-navbar.link label="Classes" route="classes.index"/>
                </li>
                <li>
                    <x-navbar.link label="Contact" route="contact.index"/>
                </li>
            </ul>
        </div>
    </div>
</nav>
