@component('layouts.base')
    <x-form.wrapper class="md:w-4/12">
        <x-form.header>Reset Password</x-form.header>

        <x-form action="{{route('password.update')}}" method="POST">
            
            <div>
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                @error('token')
                <em class="text-xs font-bold tracking-wide text-red-600">{{$message}}</em>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
                <div class="mt-2">
                    <input type="email" name="email" id="email"
                           placeholder="user@email.com"
                           value="{{old('email', $request->email)}}"
                           autocomplete="email" required
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 sm:text-sm/6">
                </div>
                @error('email')
                <em class="text-xs font-bold tracking-wide text-red-600">{{$message}}</em>
                @enderror

            </div>

            <div>
                <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                <div class="mt-2">
                    <input type="password" name="password" id="password"
                           autocomplete="new-password"
                           required
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 sm:text-sm/6">
                </div>
                @error('password')
                <em class="text-xs font-bold tracking-wide text-red-600">{{$message}}</em>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm/6 font-medium text-gray-900">
                    Confirm Password
                </label>
                <div class="mt-2">
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           autocomplete="new-password"
                           required
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 sm:text-sm/6">
                </div>
                @error('password_confirmation')
                <em class="text-xs font-bold tracking-wide text-red-600">{{$message}}</em>
                @enderror
            </div>

            <div>
                <button type="submit"
                        class="flex w-full justify-center rounded-md bg-blue-600 px-3 py-1.5 text-sm/6
                               font-semibold text-white shadow-xs hover:bg-blue-500 focus-visible:outline-2
                               focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                    Reset Password
                </button>
            </div>
        </x-form>
    </x-form.wrapper>
@endcomponent
