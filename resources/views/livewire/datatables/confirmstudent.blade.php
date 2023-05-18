<div class="flex space-x-1 justify-around">
    <x-modal :value="$fullname">
        <x-slot name="trigger">
            <button class="p-1 text-blue-600 hover:bg-blue-600 hover:text-white rounded">
                Cambiar Estado
            </button>
        </x-slot>
        <a class="text-2xl" wire:click="status({{ $value }})" x-on:click="open = false">Cambiar Estado de Pago</a>
    </x-modal>
</div>
