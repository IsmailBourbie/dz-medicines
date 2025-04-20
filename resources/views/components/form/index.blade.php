@props(['action' => '/', 'method' => ' GET'])
<div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form action="{{$action}}" method="{{$method}}" {{$attributes->merge(['class' => 'space-y-6'])}} >
        @csrf
        {{$slot}}
    </form>
</div>
