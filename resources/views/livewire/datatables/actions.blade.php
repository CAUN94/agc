<div class="flex space-x-1 justify-around">
    <x-modal :value="$fullname">
        <x-slot name="trigger">
            <button class="p-1 text-blue-600 hover:bg-blue-600 hover:text-white rounded">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
            </button>
        </x-slot>
        <a class="text-2xl" wire:click="pay({{ $value }})" x-on:click="open = false">Cambiar Estado de Pago</a>
    </x-modal>

    @include('datatables::delete', ['value' => $value, 'fullname' => $fullname])
</div>
