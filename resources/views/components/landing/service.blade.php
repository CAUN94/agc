{{-- <x-landing.modal></x-landing.modal> --}}
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
          <div class="box-container">
            <div class="box"  x-on:click="openKine = ! openKine">
                  <p>Kinesiología</p>
                  <img src="{{ asset('img/iconos/kinesiologia.png')}}">
            </div>
            <div class="box"  x-on:click="openMed = ! openMed">
                  <p>Medicina Deportiva</p>
                  <img src="{{ asset('img/iconos/medicina_deportiva.png')}}">
            </div>
            <div class="box"  x-on:click="openNutri= ! openNutri">
                  <p>Nutrición</p>
                  <img src="{{ asset('img/iconos/nutricion.png')}}">
            </div>
            <div class="box"  x-on:click="openLifeStyle = ! openLifeStyle">
                  <p>LifeStyle Medicine</p>
                  <img src="{{ asset('img/iconos/life-style-medicine.png')}}">
            </div>
            <div class="box"  x-on:click="openPsyd = ! openPsyd">
                  <p>Psicología del Deporte</p>
                  <img src="{{ asset('img/iconos/pscicologia_deportiva.png')}}">
            </div>
            <a href="/trainings">
                  <div class="box">
                        <p>Entrenamiento</p>
                        <img src="{{ asset('img/iconos/entrenamiento.png')}}">
                  </div>
            </a>
            <div class="box"  x-on:click="openPsyc = ! openPsyc">
                  <p>Psicología Clínica</p>
                  <img src="{{ asset('img/iconos/psicologia_clinica.png')}}">
            </div>
            <div class="box"  x-on:click="openTraun = ! openTraun">
                  <p>Traumatología</p>
                  <img src="{{ asset('img/iconos/traumatologia.png')}}">
            </div>
            {{-- <div class="box"  x-on:click="exampleOpen = ! exampleOpen">
                  <p>Medicina General</p>
                  <img src="{{ asset('img/iconos/medicina-general.png')}}">
            </div> --}}
            <div class="box"  x-on:click="openBio = ! openBio">
                  <p>Biomecánica</p>
                  <img src="{{ asset('img/iconos/biomecanica.png')}}">
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

            Se desarrolla en un ámbito clínico docente, es especializado y personalizado, usando la educación, ejercicio, terapia manual ortopédica y razonamiento clínico como herramientas. Bajo un modelo personalizado, su finalidad es rehabilitar y/o realizar un reintegro deportivo correcto y eficiente para quienes hayan sufrido alguna lesión, tengan molestia o dolor y deseen volver a sus actividades normales. Por otro lado, nos enfocamos en la prevención de lesiones, por lo que quienes quieran iniciar una vida más activa de manera segura y eficiente o disminuir el riesgo de la actividad física que realizan actualmente, pueden beneficiarse de la consulta de kinesiología. Busca realizar una evaluación completa, analizando la historia completa del paciente sumado a una examinación física exhaustiva para llegar a un diagnóstico funcional, evidenciando las limitaciones en la actividad y restricciones en la partición que estén influyendo en la calidad de vida de la persona. Luego se planifica e implementa un tratamiento, en donde, se educa y potencia a la persona como un ente activo en su propia rehabilitación.



            <x-slot name="button">
                  Cerrar
            </x-slot>
      </x-landing.modal-service>
      {{--    Medicina del Deporte    --}}
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



            <x-slot name="button">
                  Cerrar
            </x-slot>
      </x-landing.modal-service>
      {{--    Nutricióm    --}}
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

            El área de nutrición de You se basa en educar a la persona para que se transforme en un experto en su mundo, en donde es capaz de reconocer sus necesidades y aplicar los hábitos alimenticios que le permitan su estado óptimo de bienestar de acuerdo a sus objetivos personales y deportivos.
            <ul class="text-primary-500">
                  <li>Balance energético según objetivo </li>
                  <li>Distribución aproximada de macros </li>
                  <li>Cumplimiento de micronutrientes</li>
            </ul>

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
            Falta descripción.
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
            Se basa en la evaluación médica completa del paciente; su patología actual y factores de riesgo, tanto del entrenamiento como del deporte que realiza. Parte con una entrevista exhaustiva, examen físico general y dirigido al motivo de consulta, contemplando solicitud de exámenes complementarios e imágenes en caso de ser necesario.<br>Con los resultados de lo anterior, se realiza un diagnóstico y se indica un tratamiento dirigido al motivo de consulta y se entregan recomendaciones personalizadas, para de esta forma, atenuar los factores de riesgo de lesiones del paciente.
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
            La Biomecánica es la ciencia que analiza el movimiento humano. Tiene su base teórica en ciencias como anatomía, física, mecánica e ingeniería entre otras. Por otro lado, utiliza además diversas tecnologías en conjunto a su base teórica para cuantificar el movimiento. You Just Better ofrece diversos servicios de evaluación biomecánica:
            <x-slot name="button">
                  Cerrar
            </x-slot>
      </x-landing.modal-service>
</div>
