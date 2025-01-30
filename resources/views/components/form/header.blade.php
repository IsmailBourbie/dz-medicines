<div {{$attributes->merge(['class' => "sm:mx-auto sm:w-full sm:max-w-sm"])}}>
    <img class="mx-auto h-6 w-auto"
         src="{{asset('images/logo.svg')}}"
         alt="Your Company">
    <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">{{$slot}}</h2>
</div>
