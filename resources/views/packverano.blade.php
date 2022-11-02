<x-landing.layout>
	<img src="{{ asset('img/fotos/WEB01.png')}}" style="max-width: 100%;height: auto;">
	<div class="relative">
		<img src="{{ asset('img/fotos/WEB02.png')}}" style="max-width: 100%;height: auto;">
		  <div class="z-10 absolute top-1/2 left-1/2 transform -translate-x-1/2 translate-y-3/4">
		     <video controls>
			  <source src="movie.ogg" type="video/mov">
				Your browser does not support the video tag.
			</video>
		  </div>
	</div>
	<div class="relative w-full">
		<img src="{{ asset('img/fotos/WEB03.png')}}" style="max-width: 100%;height: auto;">
		<div class="absolute top-0 sm:top-1/3 transform translate-y-44 sm:translate-y-1/2 w-full">
			<div class="mx-auto w-3/5 sm:w-2/5 bg-you-grey mb-8 rounded-3xl py-0 sm:py-2 px-4 flex flex-col sm:flex-row items-center place-items-center justify-around mx-10 text-white">
				<div class="flex">
                <a class="text-sm sm:text-2xl" target="_blank" href="https://www.instagram.com/you.justbetter/?hl=es-la">
                    <i class="fab fa-instagram text-sm sm:text-4xl"></i>
                    you.justbetter</a>
                </div>
                <div class="flex">
				<a class="text-sm sm:text-2xl"
		        target="_blank"
		        href="https://api.whatsapp.com/send?phone=56933809726&text=Hola!">
		            <i class="fab fa-whatsapp text-sm sm:text-4xl"></i>
		            +569 33809726
		        </a>
		        </div>
			</div>
			<div class="px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg bg-primary-500 mx-auto sm:w-2/5 flex-col justify-items-center items-center">
				<div class="flex">
				<img src="{{ asset('img/fotos/Spray.png')}}" class="w-1/14 h-28">
				<div class="flex-auto">
					<div class="w-auto text-center">
						<span class="uppercase items-center text-2xl font-bold">¡Inscríbete y participa!</span>
					<form method="POST" action="/mailverano">
						@csrf
					</div>
						<div class="mx-3">
							<div class="mt-4">
			                <x-input id="name" class="block mt-1 w-full mx-auto"
			                                type="text"
			                                name="name"
			                                placeholder="Nombre Completo"/>
			           		</div>
			           		<div class="mt-4">
			           		<x-input id="phone" class="block mt-1 w-full mx-auto"
			                                type="text"
			                                name="phone"
			                                placeholder="Telefono (+56 9 7****)"/>
			           		</div>
			           		<div class="mt-4">
			           		<x-input id="pack" class="block mt-1 w-full mx-auto"
			                                type="text"
			                                name="pack"
			                                placeholder="Pack que te interesa"/>
			           		</div>
		           		</div>
	           		</div>
	           		<p class="w-1/14">&nbsp</p>
           		</div>
           		<div class="px-6 py-4 flex justify-end">
           		 <button type = 'submit' class ='mt-4 items-center px-4 py-2 bg-white border border-transparent rounded-md font-semibold text-base text-primary-500 uppercase tracking-widest hover:bg-you-grey active:bg-you-grey focus:outline-none focus:border-primary-900 focus:ring ring-primary-900 disabled:opacity-25 transition ease-in-out duration-150 w-1/3 z-20'>
           		 	Inscribirme
           		 </button>
           		 </form>
           		</div>
			</div>

			<img src="{{ asset('img/fotos/Regalo.png')}}" class="hidden sm:block -mt-24 h-40 absolute right-1/4">
		</div>
	</div>
</x-landing.layout>
