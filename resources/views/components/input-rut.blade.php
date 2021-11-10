@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-primary-100 focus:ring focus:ring-primary-100 focus:ring-opacity-50']) !!}
	onkeyup="preventDot(this.id)" oninput="preventDot(this.id)"
    placeholder="1111111-1"
>

<script type="text/javascript">
    function preventDot(id)
    {
        str = document.getElementById(id).value;
        str = (str.replace(/[^0-9k-]/g,""));
        document.getElementById(id).value = str;
    }
</script>
