<div class="py-40 flex items-center justify-center">
    <div
        {{$attributes->merge(['class' => "flex min-h-full w-11/12 flex-col justify-center px-6 py-12 lg:px-8 border border-slate-200 rounded-2xl shadow"])}}>
        {{$slot}}
    </div>
</div>
