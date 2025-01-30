@component('layouts.base')
    <x-form.wrapper class="md:w-4/12">
        <x-form.header>Sign in to your account</x-form.header>

        <x-form action="{{route('login.store')}}" method="POST">
            <div>
                <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
                <div class="mt-2">
                    <input type="email" name="email" id="email"
                           placeholder="user@email.com"
                           value="{{old('email', 'test@gmail.com')}}"
                           autocomplete="email" required
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 sm:text-sm/6">
                </div>
                @error('email')
                <em class="text-xs font-bold tracking-wide text-red-600">{{$message}}</em>
                @enderror

            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                    <div class="text-sm">
                        <a href="{{route('password.request')}}"
                           class="font-semibold text-blue-600 hover:text-blue-500">
                            Forgot password?
                        </a>
                    </div>
                </div>
                <div class="mt-2">
                    <input type="password" name="password" id="password" value="password"
                           autocomplete="current-password"
                           required
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 sm:text-sm/6">
                </div>
                @error('password')
                <em class="text-xs font-bold tracking-wide text-red-600">{{$message}}</em>
                @enderror
            </div>

            <div>
                <button type="submit"
                        class="flex w-full justify-center rounded-md bg-blue-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-blue-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                    Sign in
                </button>
            </div>
        </x-form>
        <p class="mt-10 text-center text-sm/6 text-gray-500">
            Not a member?
            <a href="#" class="font-semibold text-blue-600 hover:text-blue-500">Start a 14 day free
                trial</a>
        </p>
    </x-form.wrapper>
@endcomponent
