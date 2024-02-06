{{-- <x-landing.modal></x-landing.modal> --}}
<div
      x-data="{
      openKine: false,
      openMed: false,
      openNutri: false,
      openLifeStyle: false,
      openPsyd: false,
      openPsyc: false,
      openTraun: false,
      openBio: false,
      openTrain: false,
       }">
      <section class="bg-fixed pt-2" style="background-image: url({{ asset('img/bg-gym.jpg')}}); background-size: cover;">
          <h2 class="title">Servicios</h2>
          <div class="box-container2">
            <div class="bg-light-grey mx-auto rounded-md py-2 px-4 w-full h-auto lg:w-full cursor-pointer hover:text-primary-900 border-2 border-primary-500 hover:border-primary-900"  x-on:click="openKine = ! openKine">
                  <h2 class="text-xl">Kinesiología</h2>
                  <div class="mt-4 flex justify-between items-center">
                        <div class="w-4/5 mr-4">
                              <span class="block text-base text-justify mr-1">Buscamos rehabilitar y/o prevenir patologías muscoesqueleticas. La sesión consiste en una evaluación y tratamiento personalizado.</span>

                        </div>
                        <div class="ml-2 flex flex-col justify-between items-center">
                              <img class="h-16 lg:h-20 block bg-white rounded-full border-2 border-primary-500 hover:border-primary-900" src="{{ asset('img/iconos/kinesiologia.png')}}">
                              <span class="block text-xs sm:text-sm text-primary-500 items-center bg-you-grey mt-2 py-1 px-1.5 sm:px-2 rounded-xl text-center">Ver Más</span>
                        </div>
                  </div>
            </div>
            <div class="bg-light-grey mx-auto rounded-md py-2 px-4 w-full h-auto lg:w-full cursor-pointer hover:text-primary-900 border-2 border-primary-500 hover:border-primary-900"  x-on:click="openTraun = ! openTraun">
                  <h2 class="text-xl">Traumatología</h2>
                  <div class="mt-4 flex justify-between items-center">
                        <div class="w-4/5 mr-4">
                              <span class="block text-base text-justify mr-1">Evaluación médica, que consiste en una entrevista, examen físico e imágenes. Se realiza un diágnostico con su tratamiento respectivo.</span>
                        </div>

                        <div class="ml-2 flex flex-col justify-between items-center">
                              <img class="h-16 lg:h-20 block bg-white rounded-full border-2 border-primary-500 hover:border-primary-900" src="{{ asset('img/iconos/traumatologia.png')}}">
                              <span class="block text-xs sm:text-sm text-primary-500 items-center bg-you-grey mt-2 py-1 px-1.5 sm:px-2 rounded-xl text-center">Ver Más</span>
                        </div>
                  </div>
            </div>

            <div class="bg-light-grey mx-auto rounded-md py-2 px-4 w-full h-auto lg:w-full cursor-pointer hover:text-primary-900 border-2 border-primary-500 hover:border-primary-900"  x-on:click="openMed = ! openMed">
                  <h2 class="text-xl">Medicina Deportiva</h2>
                  <div class="mt-4 flex justify-between items-center">
                        <div class="w-4/5 mr-4">
                              <span class="block text-base text-justify mr-1">
                              Buscamos hacer un chequeo de salud del atleta desde la salud cardiaca hasta aspectos físicos, metabólicos y nutricionales.</span>
                        </div>
                        <div class="ml-2 flex flex-col justify-between items-center">
                              <img class="h-16 lg:h-20 block bg-white rounded-full border-2 border-primary-500 hover:border-primary-900" src="{{ asset('img/iconos/nutricion.png')}}">
                              <span class="block text-xs sm:text-sm text-primary-500 items-center bg-you-grey mt-2 py-1 px-1.5 sm:px-2 rounded-xl text-center">Ver Más</span>
                        </div>
                  </div>
            </div>

            <div class="bg-light-grey mx-auto rounded-md py-2 px-4 w-full h-auto lg:w-full cursor-pointer hover:text-primary-900 border-2 border-primary-500 hover:border-primary-900"  x-on:click="openNutri= ! openNutri">
                  <h2 class="text-xl">Nutrición</h2>
                  <div class="mt-4 flex justify-between items-center">
                        <div class="w-4/5 mr-4">
                              <span class="block text-base text-justify mr-1">Buscamos educar para reconocer las necesidades en función de los hábitos y aplicarlos según tus objetivos personales y deportivos.</span>
                        </div>
                        <div class="ml-2 flex flex-col justify-between items-center">
                              <img class="h-16 lg:h-20 block bg-white rounded-full border-2 border-primary-500 hover:border-primary-900" src="{{ asset('img/iconos/nutricion.png')}}">
                              <span class="block text-xs sm:text-sm text-primary-500 items-center bg-you-grey mt-2 py-1 px-1.5 sm:px-2 rounded-xl text-center">Ver Más</span>
                        </div>
                  </div>
            </div>

{{--             <div class="bg-light-grey mx-auto rounded-md py-2 px-4 w-full h-auto lg:w-full flex justify-between items-center cursor-pointer hover:text-primary-500"  x-on:click="openLifeStyle = ! openLifeStyle">
                  <div>
                        <h2>LifeStyle Medicine</h2>
                        <span class="text-sm text-primary-500">Ver Más</span>
                  </div>
                  <img class="h-16 lg:h-20 block" src="{{ asset('img/iconos/life-style-medicine.png')}}">
            </div> --}}

  {{--           <div class="bg-light-grey mx-auto rounded-md py-2 px-4 w-full h-auto lg:w-full flex justify-between items-center cursor-pointer hover:text-primary-500"  x-on:click="openPsyd = ! openPsyd">
                  <div>
                        <h2>Psicología del Deporte</h2>
                        <span class="text-sm text-primary-500">Ver Más</span>
                  </div>
                  <img class="h-16 lg:h-20 block" src="{{ asset('img/iconos/pscicologia_deportiva.png')}}">
            </div> --}}

            <div class="bg-light-grey mx-auto rounded-md py-2 px-4 w-full h-auto lg:w-full cursor-pointer hover:text-primary-900 border-2 border-primary-500 hover:border-primary-900"  x-on:click="openTrain = ! openTrain">
                  <h2 class="text-xl">Entrenamiento</h2>
                  <div class="mt-4 flex justify-between items-center">
                        <div class="w-4/5 mr-4">
                              <span class="block text-base text-justify mr-1">Disponemos de clases grupales y personalizados en horarios AM y PM. Son entrenamientos llenos de energía trabajando full body.</span>

                        </div>
                        <div class="ml-2 flex flex-col justify-between items-center">
                              <img class="h-16 lg:h-20 block bg-white rounded-full border-2 border-primary-500 hover:border-primary-900 p-2" src="{{ asset('img/iconos/entrenamiento.png')}}">
                              <span class="block text-xs sm:text-sm text-primary-500 items-center bg-you-grey mt-2 py-1 px-1.5 sm:px-2 rounded-xl text-center">Ver Más</span>
                        </div>
                  </div>
            </div>

            <!-- <a href="/trainings">
                  <div class="bg-light-grey mx-auto rounded-md py-2 px-4 w-full h-auto lg:w-full cursor-pointer hover:text-primary-900 border-2 border-primary-500 hover:border-primary-900">
                        <h2 class="text-xl">Entrenamiento</h2>
                        <div class="mt-4 flex justify-between items-center">
                              <div class="w-4/5 mr-4">
                                    <span class="block text-base text-justify mr-1">Disponemos de clases grupales y personalizados en horarios AM y PM. Son entrenamientos llenos de energía trabajando full body.</span>

                              </div>
                              <div class="ml-2 flex flex-col justify-between items-center">
                                    <img class="h-16 lg:h-20 block bg-white rounded-full border-2 border-primary-500 hover:border-primary-900 p-2" src="{{ asset('img/iconos/entrenamiento.png')}}">
                                    <span class="block text-xs sm:text-sm text-primary-500 items-center bg-you-grey mt-2 py-1 px-1.5 sm:px-2 rounded-xl text-center">Ver Más</span>
                              </div>
                        </div>
                  </div>
            </a> -->

            <div class="bg-light-grey mx-auto rounded-md py-2 px-4 w-full h-auto lg:w-full cursor-pointer hover:text-primary-900 border-2 border-primary-500 hover:border-primary-900"  x-on:click="openBio = ! openBio">
                  <h2 class="text-xl">Biomecánica</h2>
                  <div class="mt-4 flex justify-between items-center">
                        <div class="w-4/5 mr-4">
                              <span class="block text-base text-justify mr-1">Consiste en realizar análisis cuantitativos del movimiento, de la mano de la tecnología. Análisis de carrera, marcha y de fuerza son algunas de estas.</span>

                        </div>
                        <div class="ml-2 flex flex-col justify-between items-center">
                              <img class="h-16 lg:h-20 block bg-white rounded-full border-2 border-primary-500 hover:border-primary-900 p-2" src="{{ asset('img/iconos/biomecanica.png')}}">
                              <span class="block text-xs sm:text-sm text-primary-500 items-center bg-you-grey mt-2 py-1 px-1.5 sm:px-2 rounded-xl text-center">Ver Más</span>
                        </div>
                  </div>

            </div>

            


          </div>
      </section>
      {{--    Kine    --}}
      <x-landing.modal-service>
            <x-slot name="xshow">
                  openKine
            </x-slot>

            <x-slot name="title">
                  <span>Kinesiología</span>
            </x-slot>
            <x-slot name="subtitle">
                  ¿En qué consiste la consulta de Kinesiología?
            </x-slot>

            Su finalidad es rehabilitar y/o realizar un reintegro deportivo correcto y eficiente para quienes hayan sufrido alguna lesión, tengan molestia o dolor y deseen volver a sus actividades normales o rendir en el más alto nivel.  Realizamos una evaluación completa, analizando la historia del paciente junto con la examinación física exhaustiva para llegar a un diagnóstico funcional, que permita educar y potenciar a la persona como alguien capaz de llevar su propia rehabilitación.

            <x-slot name="price">
                  Desde $37,000* por hora
            </x-slot>
            <x-slot name="info">
                  *Cubierto por Isapre con licencia médica, consulta por Bono Fonasa.
            </x-slot>

            <x-slot name="button">
                  Cerrar
            </x-slot>
      </x-landing.modal-service>

      {{--    Traumatología   --}}
      <x-landing.modal-service>
            <x-slot name="xshow">
                  openTraun
            </x-slot>

            <x-slot name="title">
                  Traumatología
            </x-slot>
            <x-slot name="subtitle">
                  ¿Que és la consulta de Traumatología?
            </x-slot>
            Evaluación médica completa del paciente, realizando una entrevista exhaustiva, examen físico general y dirigido al motivo de consulta, contemplando solicitud de exámenes complementarios e imágenes en caso de ser necesario. Se realiza un diagnóstico y se indica un tratamiento dirigido al motivo de la consulta, donde se entregan recomendaciones personalizadas para atenuar los factores de riesgo de lesiones del paciente.
            <x-slot name="price">
                  Desde $50,000* p/consulta
            </x-slot>
            <x-slot name="info">
                  *Cubierto por Isapre con licencia médica, consulta por Bono Fonasa.
            </x-slot>

            <x-slot name="button">
                  Cerrar
            </x-slot>
      </x-landing.modal-service>

      <!-- Medicina del Deporte -->
      <x-landing.modal-service>
            <x-slot name="xshow">
                  openMed
            </x-slot>

            <x-slot name="title">
                  Medicna Deportiva
            </x-slot>
            <x-slot name="subtitle">
                  ¿En qué consiste la consulta Medicina del Deporte?
            </x-slot>

            En consulta de medicina del deporte, se busca hacer un chequeo de salud del atleta, desde la salud cardiaca hasta aspectos físicos, metabólicos y nutricionales. Además, se revisan aspectos que impactan directamente sobre el rendimiento deportivo y la aparición de lesiones, como por ejemplo el sueño, y los niveles de hierro o de vitamina D dentro de otros.<br>En el caso de una lesión hay dos caminos en paralelo; primero se debe ajustar la carga de entrenamiento, pero además y de manera paralela se generan estrategias para mantener la condición física y prevenir el desentrenamiento. Posterior a la rehabilitación se busca un reintegro deportivo óptimo, buscando los factores que desencadenaron la lesión y corrigiendolos.<br><br><span class="text-primary-500">Ejercicio como tratamiento</span>
            El ejercicio sirve para tratar y prevenir 26 enfermedades diferentes, desde la hipertensión arterial y diabetes hasta ocho tipos distintos de cáncer. Se trabaja en el formato de toma de decisión en conjunto al paciente, para buscar la mejor forma de potenciar su salud o tratar una enfermedad. Para esto se toma en cuenta las preferencias de la persona, su condición física actual y factores propios de cada enfermedad para lograr una práctica de ejercicio segura y efectiva.

            <x-slot name="price">
                  Desde $50,000* p/consulta
            </x-slot>


            <x-slot name="button">
                  Cerrar
            </x-slot>
      </x-landing.modal-service>

      {{--    Nutrición    --}}
      <x-landing.modal-service>
            <x-slot name="xshow">
                  openNutri
            </x-slot>

            <x-slot name="title">
                  Nutrición
            </x-slot>
            <x-slot name="subtitle">
                  La Nutrición en You Just Better
            </x-slot>

            Se basa en educar a la persona para que se transformes en un experto en su mundo, donde sea capaz de reconocer sus necesidades y aplicar los hábitos alimenticios que le permitan su estado óptimo de bienestar de acuerdo a sus objetivos personales y deportivos. Entregamos balance energético según objetivo, distribución de macro y micronutrientes para llegar a su objetivo.

            <x-slot name="price">
                  Desde $47,000* p/consulta
            </x-slot>

            <x-slot name="button">
                  Cerrar
            </x-slot>
      </x-landing.modal-service>

      {{--    LifeStyle Medicine   --}}
      <x-landing.modal-service>
            <x-slot name="xshow">
                  openLifeStyle
            </x-slot>

            <x-slot name="title">
                  LifeStyle Medicine
            </x-slot>
            <x-slot name="subtitle">
                  ¿Que és la consulta Lifestyle Medicine?
            </x-slot>
            Atención médica completa, inicia con una entrevista amplia y detallada al paciente, comprendiendo su historial médico completo, examen físico y solicitud de exámenes complementarios en caso de requerirse. Con todos estos antecedentes se realiza una evaluación del estado de salud actual, identificando los hábitos que se deben fortalecer y aquellos que se deben modificar para encaminar al paciente hacia una vida más sana. Tras la evaluación se entregan recomendaciones de forma personalizada, bajo la supervisión y guía del médico según la última evidencia científica actual, con el objetivo de lograr cambios de manera eficaz y sostenible en el tiempo, siempre desde un enfoque realista que se adecue al ritmo y estilo de vida de cada paciente en particular.
            <x-slot name="button">
                  Cerrar
            </x-slot>
      </x-landing.modal-service>

      {{--    Psicología del Deporte   --}}
      <x-landing.modal-service>
            <x-slot name="xshow">
                  openPsyd
            </x-slot>

            <x-slot name="title">
                  Psicología del Deporte
            </x-slot>
            <x-slot name="subtitle">
                  ¿Que és la consulta Psicología del Deporte?
            </x-slot>
            En la consulta de Psicología del Deporte se indagan las variables que favorecen un buen rendimiento deportivo y, por otro lado, aquellas que impiden lograr objetivos. Luego de la evaluación inicial se establece el objetivo en conjunto con el paciente. De esta manera se busca optimizar el rendimiento de la persona.<br>Esto se logra a través de una evaluación completa con una entrevista inicial, para posteriormente trabajar en las debilidades y fortalezas de la persona, enseñándoles técnicas y estrategias para concentrarse más, controlar el estrés, tener confianza, entre otros aspectos.
            <x-slot name="button">
                  Cerrar
            </x-slot>
      </x-landing.modal-service>

      {{--    Psicología Clínica   --}}
      <x-landing.modal-service>
            <x-slot name="xshow">
                  openPsyc
            </x-slot>

            <x-slot name="title">
                  Psicología Clínica
            </x-slot>
            <x-slot name="subtitle">
                  ¿Que és la consulta Psicología Clínica?
            </x-slot>
            En las primeras sesiones se entrevista al consultante con el fin de conocerlo e identificar el origen del motivo de consulta. En las siguientes sesiones se trabajan estrategias y técnicas para conseguir una mejora en su bienestar personal, entregando herramientas para enfrentarse y abordar el motivo de consulta inicial.
            <x-slot name="price">
                  Desde $35,000* p/consulta
            </x-slot>

            <x-slot name="button">
                  Cerrar
            </x-slot>
      </x-landing.modal-service>

      {{--    Biomecánica   --}}
      <x-landing.modal-service>
            <x-slot name="xshow">
                  openBio
            </x-slot>

            <x-slot name="title">
                  Biomecánica
            </x-slot>
            <x-slot name="subtitle">
                  ¿Que és la consulta de Biomecánica?
            </x-slot>
            Área que, de la mano de la tecnología, realiza un análisis cuantitativo del movimiento. Tiene su base teórica en ciencias como anatomía, física, mecánica e ingeniería entre otras. Podrás encontrar análisis de carrera, de marcha y de fuerza entre otros exámenes, además la rehabilitación de patrón de carrera.
            <x-slot name="price">
                  Desde $70,000* p/consulta
            </x-slot>

            <x-slot name="button">
                  Cerrar
            </x-slot>
      </x-landing.modal-service>
      {{--    Entrenamiento   --}}
      <div  x-show="openTrain" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-cloak>
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full" @click.away="openTrain = false">
                  <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                  <div class="sm:flex sm:items-start">
                  <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                        <!-- Heroicon name: outline/exclamation -->
                        <img src="{{asset('img/icon.png')}}">
                  </div>
                  <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                              Entrenamiento
                        </h3>
                        <span class="text-primary-500 mt-2 text-base block">¿En que consiste el servicio de entrenamiento?</span>
                        <div>
                        <p class="overflow-y-auto text-base text-gray-500 mt-2 text-justify  leading-relaxed ">
                        ¡Tenemos distintos planes de entrenamiento que te podrían interesar!
                        Tenemos planes personalizados y para duplas, donde el entrenador se va a enfocar particularmente en los objetivos y necesidades del/los alumnos.
                        Por otro lado tenemos clases grupales donde trabajarás todo el cuerpo para mejorar tu estado físico. Estas no son masivas, por lo que el entrenador está atento a cada alumno para brindarle la mejor calidad de servicio.
                        </p>
                        </div>
                  </div>
                  </div>
                  </div>
                  <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                  <div class="flex flex-col">
                  <a href="/trainings" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary-500 text-base font-medium text-white hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Desde $52.000
                  </a>
                  </div>
                  <button x-on:click="openTrain = ! openTrain" type="button" class="mt-3 self-start w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cerrar
                  </button>

                  </div>

            </div>

            </div>
            </div>
</div>
