@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-primary-500">
            {{ __('Uups, parece que tienes algunos errores.') }}
        </div>

        <ul class="mt-3 list-disc list-inside text-sm text-primary-500">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
