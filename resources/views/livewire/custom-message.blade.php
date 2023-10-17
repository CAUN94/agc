<div class="flex flex-col md:flex-row gap-x-3 gap-y-1 md:gap-y-0">
    <div class="md:w-3/5 order-2 md:order-1 overflow-x-auto gap-y-2 box-white p-3">
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-6">
                <label for="tag" class="block text-sm font-medium text-gray-700 mb-2">Etiqueta</label>
                <div class="flex">
                    <input type="text" name="tag" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block shadow-sm sm:text-sm border-gray-300 rounded-md" type="text" wire:model="tagValue" placeholder="Nueva Etiqueta">
                    <button class="inline-flex justify-center mx-2 py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer" wire:click="addTag">Agregar Etiqueta</button>
                </div>
            </div>
        </div>
        <div class="mt-2 flex flex-col gap-y-2">
            @foreach($tagsArray as $tag => $value)
                <div class="flex gap-x-2 items-center">
                    <span class="font-bold">- Etiqueta: </span>
                    <span>{{ $tag }}</span>
                    <div>
                        <span class="font-bold">Valor:</span>
                        <input type="text" wire:model="tagsArray.{{ $tag }}" wire:change="generateMessage" wire:keydown.enter="saveTag" class="focus:ring-primary-500 focus:border-primary-500 shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div>
        
    </div>
    <div class="md:w-2/5 order-1 md:order-2 overflow-x-auto gap-y-2 box-white p-3">
        <div class="flex flex-col">
            <label class="font-bold">Mensaje por Defecto:</label>
            <textarea wire:model="message" rows="10"></textarea>
            <div class="my-4">Mensaje:<br>{!! nl2br($generatedMessage) !!}</div>
            <a href="{{ $whatsAppLink }}" target="_blank">Abrir en WhatsApp</a>
        </div>
    </div>
</div>
<script>
    document.querySelector('input[name="message"]').addEventListener('input', function () {
        window.livewire.emit('messageUpdated', this.value);
    });
</script>

