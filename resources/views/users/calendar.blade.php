<x-landing.layout>
  <x-landing.user-panel>
    <div class="w-full order-2 sm:order-1 flex flex-col gap-4 h-full">
      <div class="bg-gray-50 shadow overflow-hidden sm:rounded-lg">
        <div class="flex px-4 py-5 sm:px-6 justify-between">
          <div class="flex justify-between w-full">
            <h3 class="text-base sm:text-2xl leading-2 font-medium text-primary-500">
              Tus próximas horas agendedadas en You
            </h3>
          </div>
        </div>
      </div>
      <div class="bg-gray-50 shadow overflow-hidden sm:rounded-lg">
        <div class="flex px-4 py-3 sm:px-6 justify-between">
          <div class="flex justify-between items-center w-full">
            <h3 class="text-lg leading-6 font-medium text-primary-500">
              Atenciones de salud:
            </h3>
            {{Auth::user()->nextAppointments()->paginate(2)->links()}}
          </div>
        </div>
      </div>
      <div class="w-full h-full grid grid-cols-1 sm:grid-cols-2 gap-4">
          @forelse(Auth::user()->nextAppointments()->paginate(2) as $appointment)
            @php
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $fecha = \Carbon\Carbon::parse($appointment->Fecha);

            $horai = \Carbon\Carbon::parse($appointment->Hora_inicio)->format('H:i');
            $horaf = \Carbon\Carbon::parse($appointment->Hora_termino)->format('H:i');
            $mes = $meses[($fecha->format('n')) - 1];
            $date = $fecha->format('d') . ' de ' . $mes;
            @endphp
            <div class="bg-gray-50 shadow overflow-hidden sm:rounded-lg ">
              <div class="border-4 border-primary-500 border-current">
                <div class="bg-white text-sm px-4 py-5 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-6 overflow-y-scroll">
                  <div class="flex justify-between items-center">
                    <div class="text-base flex flex-col">
                      <span>{{$date}}</span>
                      <span>Hora: {{$horai}} {{$horaf}}</span>
                      <span>Profesional: {{ $appointment->Profesional}}</span>
                      @if($appointment->treatments()->isPay())
                      < span class="text-green-500">Pagado</span>
                      @else
                        <x-medilinkpay id="{{$appointment->treatments()->id}}"></x-medilinkpay>
                      @endif
                    </div>
                    @if(!$appointment->professional_calendar)
                    <a href="/calendar/store/{{$appointment->id}}" class="flex items-center">Agregar a Calendario <img class="ml-2 h-8 w-8" src="{{ asset('/img/calendar.png') }}"></a>
                    @else
                      Agenado en Calendario
                    @endif

                  </div>
                </div>
              </div>
            </div>
          @empty
            <div class="bg-gray-50 shadow overflow-hidden sm:rounded-lg ">
              <div>
                <div class="bg-white text-sm px-4 py-5 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-6 overflow-y-scroll">
                  <div class="flex justify-between items-center">
                    <div class="text-base flex flex-col">
                       <a href="https://f8f6bc91ed06a41fb6527cdbb7dd65b9638c84fd.agenda.softwaremedilink.com/agendas/agendamiento" class="text-primary-500">Agendar Hora</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforelse
      </div>
      @if($user->isStudent())
        <div class="bg-gray-50 shadow overflow-hidden sm:rounded-lg ">
          <div class="flex px-4 py-3 sm:px-6 justify-between">
            <div class="flex flex-col sm:flex-row gap-y-2 sm:gap-y-0 justify-between items-center w-full">
              <h3 class="text-base sm:text-lg leading-6 font-medium text-primary-500">
                Planes de Entrenamiento
              </h3>
              <x-pay>Pagar</x-pay>
              {{Auth::user()->allStudentPlan()->with('Training')->paginate(2)->links()}}
            </div>
          </div>
        </div>
        <div class="w-full h-full grid grid-cols-2 gap-4">
            @forelse(Auth::user()->allStudentPlan()->with('Training')->paginate(2) as $plan)
              <div class="bg-gray-50 shadow overflow-hidden sm:rounded-lg ">
                <div class="border-4 border-primary-500 border-current">
                  <div class="bg-white text-sm px-4 py-5 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-6 overflow-y-scroll">
                    <div class="flex justify-between items-center">
                      <div class="text-sm sm:text-base flex flex-col">
                        <a href="/students"> {{$plan->trainingPlan()}}</a>
                        <span class="text-sm sm:text-base text-primary-500">
                        {{$plan->Training->planClassComplete()}}
                      </span>
                      <span class="text-sm sm:text-base text-primary-500 mb-2">
                        Inicio: {{ $plan->start_day()}}
                      </span>
                      @if($plan->isSettled())
                        <span class="text-sm sm:text-base text-green-500">Pagado</span>
                      @else
                        <span class="text-sm sm:text-base text-red-500">No Pagado {{$plan->trainingPrice()}}</span>
                      @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @empty
              <div class="bg-gray-50 shadow overflow-hidden sm:rounded-lg ">
                <div>
                  <div class="bg-white text-sm px-4 py-5 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-6 overflow-y-scroll">
                    <div class="flex justify-between items-center">
                      <div class="text-base flex flex-col">
                         <a href="/trainings" class="text-primary-500">Ver Planes de Entrenamiento</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforelse
        </div>
      @endif
      <div class="bg-gray-50 shadow overflow-hidden sm:rounded-lg ">
        <div class="flex px-4 py-3 sm:px-6 ">
          <div class="flex flex-col items-center w-full">
            <div class="text-center text-sm sm:text-base leading-6 font-medium text-primary-500 flex items-center">
              Métodos de pago: Crédito / Débito <img class="ml-2 h-10 sm:w-14 sm:h-10 sm:w-14" src="{{ asset('/img/mp.png') }}">
            </div>
            <a class="text-center text-sm sm:text-base mt-2 leading-6 font-medium you-grey" href="https://api.whatsapp.com/send?phone=56933809726&text=Hola!" >
              ¿Necesitas adelantar tu hora? Contactános
              <i class="ml-2 fab fa-whatsapp text-xl"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </x-landing.user-panel>
</x-landing.layout>
