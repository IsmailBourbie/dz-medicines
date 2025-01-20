<div class="flex space-x-4">
    <div>
        <label for="types" class="sr-only">Select
            a type</label>
        <select id="types"
                wire:model.live="type"
                class="min-w-40 border-b border-slate-400 text-gray-900 text-sm block p-1.5">
            <option value="all" selected>All Types</option>
            <option value="generics">Generics</option>
            <option value="innovators">Innovators</option>
        </select>
    </div>
    <div>
        <label for="origins" class="sr-only">Select
            an origin</label>
        <select id="origins"
                wire:model.live="origin"
                class="min-w-40 border-b border-slate-400 text-gray-900 text-sm block p-1.5">
            <option value="all" selected>All Origin</option>
            <option value="local">Local</option>
            <option value="foreign">Foreign</option>
        </select>
    </div>
</div>
