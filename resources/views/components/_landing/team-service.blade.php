<section class="bg-light-grey py-2">
	<div class="flex flex-wrap justify-center">
	 	<x-landing.circle-icon>
	 		<x-slot name="img">{{asset('img/icon.png')}}</x-slot>
	 		Equipo
	 	</x-landing.circle-icon>
		<x-landing.circle-icon>
			<x-slot name="img">{{asset('/img/iconos/kinesiologia-white.png')}}</x-slot>
			Kinesiología
		</x-landing.circle-icon>
		<x-landing.circle-icon>
			<x-slot name="img">{{asset('/img/iconos/traumatolgia-white.png')}}</x-slot>
			Traumatología
		</x-landing.circle-icon>
		<x-landing.circle-icon>
			<x-slot name="img">{{asset('/img/iconos/nutricion-white.png')}}</x-slot>
			Nutrición
		</x-landing.circle-icon>
		<x-landing.circle-icon>
			<x-slot name="img">{{asset('/img/iconos/medicina_general-white.png')}}</x-slot>
			Medicina General
		</x-landing.circle-icon>
		<x-landing.circle-icon>
			<x-slot name="img">{{asset('/img/iconos/biomecanica-white.png')}}</x-slot>
			Biomecánica
		</x-landing.circle-icon>
		<x-landing.circle-icon>
			<x-slot name="img">{{asset('/img/iconos/life-style-medicine.png')}}</x-slot>
			LifeStyle Medicine
		</x-landing.circle-icon>
		<x-landing.circle-icon>
			<x-slot name="img">{{asset('/img/iconos/entrenamiento-white.png')}}</x-slot>
			Entrenamiento
		</x-landing.circle-icon>
		<x-landing.circle-icon>
			<x-slot name="img">{{asset('/img/iconos/pscicologia_clinica-white.png')}}</x-slot>
			Psicología Clinica
		</x-landing.circle-icon>
		<x-landing.circle-icon>
			<x-slot name="img">{{asset('/img/iconos/pscicologia_deportiva-white.png')}}</x-slot>
			Psicología Deportiva
		</x-landing.circle-icon>
		<x-landing.circle-icon>
			<x-slot name="img">{{asset('/img/iconos/medicina_deportiva-white.png')}}</x-slot>
			Medicina Deportiva
		</x-landing.circle-icon>
		<x-landing.circle-icon>
			<x-slot name="img">{{asset('/img/iconos/desarrollo-white.png')}}</x-slot>
			Desarrollo
		</x-landing.circle-icon>

	</div>



{{-- 	<div x-data="areas()">
	    <span x-on:click="kine = ! kine">Toggle Dropdown</span>
	    <div x-show="kine">
	        Kine
	    </div>
	    <div x-show="a">
	        a
	    </div>
	    <div x-show="b">
	        b
	    </div>
	    <div x-show="c">
	        c
	    </div>
	    <div x-show="d">
	        d
	    </div>
	</div>
	<script>
		function areas(){
			return {
				'kine' : false,
				'a' : false,
				'b' : false,
				'c' : false,
				'd' : false,
			}
		}
	</script> --}}
</section>
