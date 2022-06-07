{{-- <x-landing2.modal></x-landing2.modal> --}}
<div x-data="{
      openKine: false,
      openMed: false,
      openNutri: false,
      openLifeStyle: false,
      openPsyd: false,
      openPsyc: false,
      openTraun: false,
      openBio: false
       }">
      <section class="bg-fixed pt-2" style="background-image: url({{ asset('img/bg-gym.jpg')}}); background-size: cover;">
          <h2 class="title">Servicios</h2>
          <div class="box-container2">
            <div class="box"  x-on:click="openKine = ! openKine">
                  <div>
                        <h2>Kinesiología</h2>
                        <span class="block text-sm text-primary-900">Rehabilitar, Reintegro, Evaluación</span>
                        <span class="block text-sm text-primary-500">Ver Más</span>
                  </div>
                  <img src="{{ asset('img/iconos/kinesiologia.png')}}">
            </div>
            <div class="box"  x-on:click="openTraun = ! openTraun">
                  <div>
                        <h2>Traumatología</h2>
                        <span class="block text-sm text-primary-900">Evaluación, Examen Físico, Diagnóstico</span>
                        <span class="block text-sm text-primary-500">Ver Más</span>
                  </div>
                  <img src="{{ asset('img/iconos/traumatologia.png')}}">
            </div>
{{--             <div class="box"  x-on:click="openMed = ! openMed">
                  <div>
                        <h2>Medicina Deportiva</h2>
                        <span class="text-sm text-primary-500">Ver Más</span>
                  </div>
                  <img src="{{ asset('img/iconos/medicina_deportiva.png')}}">
            </div> --}}
            <div class="box"  x-on:click="openNutri= ! openNutri">
                  <div>
                        <h2>Nutrición</h2>
                        <span class="block text-sm text-primary-900">Hábitos alimenticios, Balance</span>
                        <span class="block text-sm text-primary-500">Ver Más</span>
                  </div>
                  <img src="{{ asset('img/iconos/nutricion.png')}}">
            </div>

{{--             <div class="box"  x-on:click="openLifeStyle = ! openLifeStyle">
                  <div>
                        <h2>LifeStyle Medicine</h2>
                        <span class="text-sm text-primary-500">Ver Más</span>
                  </div>
                  <img src="{{ asset('img/iconos/life-style-medicine.png')}}">
            </div> --}}

  {{--           <div class="box"  x-on:click="openPsyd = ! openPsyd">
                  <div>
                        <h2>Psicología del Deporte</h2>
                        <span class="text-sm text-primary-500">Ver Más</span>
                  </div>
                  <img src="{{ asset('img/iconos/pscicologia_deportiva.png')}}">
            </div> --}}

            <a href="/trainings">
                  <div class="box">
                        <div>
                              <h2>Entrenamiento</h2>
                              <span class="block text-sm text-primary-900">Deporte, Personalizado</span>
                              <span class="block text-sm text-primary-500">Ver Más</span>
                        </div>
                        <img src="{{ asset('img/iconos/entrenamiento.png')}}">
                  </div>
            </a>

            <div class="box"  x-on:click="openBio = ! openBio">
                  <div>
                        <h2>Biomecánica</h2>
                        <span class="block text-sm text-primary-900">Análisis de Movimiento y Carrera</span>
                        <span class="block text-sm text-primary-500">Ver Más</span>
                  </div>
                  <img src="{{ asset('img/iconos/biomecanica.png')}}">
            </div>

            <div class="box"  x-on:click="openPsyc = ! openPsyc">
                  <div>
                        <h2>Psicología Clínica</h2>
                        <span class="block text-sm text-primary-900">Bienestar Personal, Herramientas</span>
                        <span class="block text-sm text-primary-500">Ver Más</span>
                  </div>
                  <img src="{{ asset('img/iconos/psicologia_clinica.png')}}">
            </div>
            {{-- <div class="box"  x-on:click="exampleOpen = ! exampleOpen">
                  <div>
                  <h2>Med      icina General</h2>
                  <span class="text-sm text-primary-500">Ver Más</span>
                        </div>
                        <img s      rc="{{ asset('img/iconos/medicina-general.png')}}">
            </div> --}}


          </div>
      </section>
      {{--    Kine    --}}
      <x-landing2.modal-service>
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
                  Desde $32,000* por hora
            </x-slot>
            <x-slot name="info">
                  *Cubierto por Isapre con licencia médica
            </x-slot>

            <x-slot name="button">
                  Cerrar
            </x-slot>
      </x-landing2.modal-service>

      {{--    Traumatología   --}}
      <x-landing2.modal-service>
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
                  Desde $48,000* p/consulta
            </x-slot>

            <x-slot name="button">
                  Cerrar
            </x-slot>
      </x-landing2.modal-service>

      {{--    Medicina del Deporte    --}}
      {{-- <x-landing2.modal-service>
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



            <x-slot name="button">
                  Cerrar
            </x-slot>
      </x-landing2.modal-service> --}}

      {{--    Nutrición    --}}
      <x-landing2.modal-service>
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
                  Desde $48,000* p/consulta
            </x-slot>

            <x-slot name="button">
                  Cerrar
            </x-slot>
      </x-landing2.modal-service>

      {{--    LifeStyle Medicine   --}}
      <x-landing2.modal-service>
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
      </x-landing2.modal-service>

      {{--    Psicología del Deporte   --}}
      <x-landing2.modal-service>
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
      </x-landing2.modal-service>

      {{--    Psicología Clínica   --}}
      <x-landing2.modal-service>
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
      </x-landing2.modal-service>

      {{--    Biomecánica   --}}
      <x-landing2.modal-service>
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
                  Desde $64,000* p/consulta
            </x-slot>

            <x-slot name="button">
                  Cerrar
            </x-slot>
      </x-landing2.modal-service>
</div>
