@php
    $data = explode(',', $slot);
@endphp

{{-- data = [answers,name] --}}

<div class ="card-body justify-around my-2 ml-2">
    @for ($i = 0; $i <= sizeof($data)-2; $i++)
        <div class="sm:px-1">
            <input
                class="checked:bg-[#f2715a] form-check-input sm:mx-1"
                type="radio"
                value="{{ $data[$i] }}"
                name="{{ end($data) }}"
                id="{{ $data[$i] }}"
                {{ in_array($data[$i], old(end($data), [])) ? 'checked' : '' }}>
            <label class="sm:mx-1" for="{{ $data[$i] }}">
                {{ $data[$i] }}
            </label>
        </div>
    @endfor
</div>

<div>
    @error(end($data))
        <h5
        class="card-header inline-flex justify-around"
        style="font-size: 0.9rem; width: 100%; background-color: rgba(242,113,90,0.6); border-radius: 0.25rem;">
            Por favor ingrese uno o más valores
        </h5>
    @enderror
</div>
