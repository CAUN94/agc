@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-primary-100 focus:ring focus:ring-primary-100 focus:ring-opacity-50']) !!}
	onkeyup="preventDot(this.id)" maxlength="12" oninput="checkRut(this.id)"
    placeholder="1111111-1"
>

