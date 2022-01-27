@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-primary-100 focus:ring focus:ring-primary-100 focus:ring-opacity-50']) !!}
	onkeyup="preventDot(this.id)" maxlength="12" oninput="checkRut(this.id)"
    placeholder="1111111-1"
>

<script type="text/javascript">
    function preventDot(id)
    {
        document.getElementById('rut').addEventListener('input', function(evt) {
          let value = this.value.replace(/\./g, '').replace('-', '');

          if (value.match(/^(\d{2})(\d{3}){2}(\w{1})$/)) {
            value = value.replace(/^(\d{2})(\d{3})(\d{3})(\w{1})$/, '$1$2$3-$4');
          }
          this.value = value;
        });
    }

</script>
