<h2
    {{ $attributes->merge([
    'class' => "font-quicksand font-medium text-2xl text-sky-800 relative after:absolute after:-z-10 after:left-0 after:top-1/2 after:w-full after:h-[2px] after:bg-sky-600 transform after:-translate-y-1/2"
    ]) }}
>
    <div class="bg-white pe-2 inline">
        {{$slot}}
    </div>
</h2>
