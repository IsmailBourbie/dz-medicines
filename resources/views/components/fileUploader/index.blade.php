<div x-data="{ fileName: '' }"
     class="relative flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-lg hover:bg-gray-50">
    <input type="file" name="file" accept=".xls,.xlsx" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
           required
           @change="fileName = $event.target.files[0]?.name">
    <div class="text-center">
        <x-icons.cloud-arrow-up size="4xl" class="text-gray-400 mx-auto"/>
        <p class="mt-2 text-sm text-gray-600">
            Drag & drop your file here, or <span class="text-blue-600 hover:underline">click to select</span>
        </p>
        <template x-if="fileName">
            <p class="mt-2 px-4 text-sm font-medium text-gray-800" x-text="fileName"></p>
        </template>
    </div>
</div>
