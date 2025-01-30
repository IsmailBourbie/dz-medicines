@props(['action' => '/', 'method' => ' GET'])
<div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form class="space-y-6" action="{{$action}}" method="{{$method}}">
        @csrf
        {{$slot}}
    </form>
</div>
