<x-landing.layout>
  <x-landing.user-panel>
    <div class="w-full order-2 sm:order-1 sm:w-3/6 bg-gray-50 shadow overflow-hidden sm:rounded-lg">
      <div class="flex px-4 py-5 sm:px-6 justify-between">
        <div class="flex flex-col">
          <h3 class="text-lg leading-6 font-medium text-primary-500">
            {{ $user->fullName() }}
          </h3>
          <p class="mt-1 max-w-2xl text-sm text-gray-500">
            Perfil personal de usuarios You Just Better
          </p>
        </div>
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-1">
            <img src="{{$user->profilePic()}}" class="avatar h-12 w-12">
        </div>
      </div>
      <div class="border-t border-gray-200">
        <dl>
          <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">
              Nombre y Apellido
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              {{ $user->fullName() }}
            </dd>
          </div>
          <div class="bg-white border-t border-gray-200 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">
              Rut
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              {{ $user->rut }}
            </dd>
          </div>
          <div class="bg-white border-t border-gray-200 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">
              Email
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              {{ $user->email }}
            </dd>
          </div>
          <div class="bg-white border-t border-gray-200 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">
              Genero
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              {{ $user->gender() }}
            </dd>
          </div>
          <div class="bg-white border-t border-gray-200 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">
              Fecha de Nacimieno
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{date('d M Y', strtotime($user->birthday ))}}
            </dd>
          </div>
          <div class="bg-white border-t border-gray-200 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">
              Celular
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              {{ $user->phone }}
            </dd>
          </div>
          <div class="bg-white border-t border-gray-200 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">
              Dirección
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ $user->address() }}
            </dd>
          </div>
          <div class="bg-white border-t border-gray-200 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">
              Descripcion
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              {{ $user->description() }}
            </dd>
          </div>
          @if ($user->hasAlliance())
          <div class="bg-white border-t border-gray-200 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">
              Alianza
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              {{ $user->alliance()->name }}
            </dd>
          </div>
          @endif
          @if ($user->isStudent())
          <div class="{{ $user->student()->isSettled() ? "bg-white" : "bg-red-100" }} border-t border-gray-200 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">
              Plan de Entrenamiento Actual
              <div class="text-xs {{ $user->student()->isSettled() ? "text-green-500" : "text-red-500" }}">
                @if(Auth::user()->student()->isSettled())
                    Plan activado
                @else
                    <div class="flex flex-col">
                        <span>Plan No activado</span>
                        <span>Valor: {{Auth::user()->student()->trainingPrice()}}</span>
                    </div>
                @endif
              </div>
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex justify-between items-center">
              <div>
                {{ $user->student()->trainingPlan() }}
                <span class="text-sm text-primary-500">
                  {{$user->Training->planClassComplete()}}
                </span>
                <div class="text-sm text-gray-500">
                  Inicio: {{ $user->student()->start_day()}}
                </div>
                <div class="text-sm text-gray-500">
                  Vence: {{ $user->student()->endMonth()->format('d M Y')}}
                  <span class="text-sm text-primary-500">
                    ({{ $user->student()->diffdaysplan() }})
                  </span>
                </div>
              </div>
              @if($user->isStudent())
                <a href="/students" class="text-primary-500">Ver Clases y Horarios</a>
              @endif
            </dd>
          </div>
          @endif
          <!-- <div class="bg-white border-t border-gray-200 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">
              Registrado desde
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              {{ $user->created_at->format('d M Y'); }}
            </dd>
          </div> -->
        </dl>
        <div class="px-4 py-3 bg-white border-t border-gray-200 text-right sm:px-6">
          <a href="users/{{$user->id}}/edit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-900">
            Editar
          </a>
        </div>
      </div>
    </div>


    <div class="w-full order-1 sm:order-2 sm:w-2/6 flex flex-col gap-y-4">
        <div class="h-auto bg-gray-50 shadow overflow-hidden sm:rounded-lg ">
          <div class="flex px-4 py-5 sm:px-6 justify-between">
            <div class="flex flex-col">
              <h3 class="text-lg leading-6 font-medium text-primary-500">
                Clínica You
              </h3>
              <p class="mt-1 max-w-2xl text-sm text-gray-500">
                  <span class="text-gray-500">Proximas horas</span>
              </p>
            </div>
            <div class="bg-white shadow overflow-hidden sm:rounded-lg p-1">
                <img src="{{$user->profilePic()}}" class="avatar h-12 w-12">
            </div>
          </div>
          <div class="border-t border-gray-200">
            <div class="bg-white text-sm px-4 py-5 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-6 overflow-y-scroll">
              @forelse(Auth::user()->nextAppointments()->paginate(3) as $appointment)
                <div class="flex justify-between items-center">
                  <div class="flex flex-col">
                    @php
                    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                    $fecha = \Carbon\Carbon::parse($appointment->Fecha);

                    $hora = \Carbon\Carbon::parse($appointment->Hora_inicio)->format('H:i');
                    $mes = $meses[($fecha->format('n')) - 1];
                    $date = $fecha->format('d') . ' de ' . $mes . ' a las ' . $hora;
                    @endphp
                    {{$date}}
                    {{-- en San Pascual 736 --}}
                    {{-- <span class="text-xs text-primary-500">

                    </span> --}}
                    <span class="text-xs text-primary-500">
                      Profesional: {{ $appointment->Profesional}}
                    </span>
                  </div>
                  @if($appointment->hasTreatments())
                    @if($appointment->treatments()->isPay())
                      <span class="text-green-500">Pagado</span>
                    @else
                      <x-medilinkpay id="{{$appointment->treatments()->id}}">Pagar</x-medilinkpay>
                    @endif
                  @endif
                </div>
              @empty
                <a href="https://f8f6bc91ed06a41fb6527cdbb7dd65b9638c84fd.agenda.softwaremedilink.com/agendas/agendamiento" class="items-center mt-2 px-4 py-2 bg-primary-500 border border-transparent rounded-md font-semibold text-base text-white uppercase tracking-widest hover:bg-primary-900 active:bg-primary-900 focus:outline-none focus:border-primary-900 focus:ring ring-primary-100 disabled:opacity-25 transition ease-in-out duration-150 text-center">Reservar Nueva Hora</a>
              @endforelse
              {{Auth::user()->nextAppointments()->paginate(3)->links()}}
            </div>
          </div>
        </div>
        <div class="h-auto bg-gray-50 shadow overflow-hidden sm:rounded-lg ">
          <div class="flex px-4 py-5 sm:px-6 justify-between">
            <div class="flex flex-col">
              <h3 class="text-lg leading-6 font-medium text-primary-500">
                Historial Planes de Entrenamiento
              </h3>
              <p class="mt-1 max-w-2xl text-sm text-gray-500">
                @if($user->isStudent())
                  <a href="/students" class="text-gray-500 underline">Ver Clases y Horarios</a>
                @endif
              </p>
            </div>
            <div class="bg-white shadow overflow-hidden sm:rounded-lg p-1">
                <img src="{{$user->profilePic()}}" class="avatar h-12 w-12">
            </div>
          </div>
          <div class="border-t border-gray-200">
            <div class="bg-white text-sm px-4 py-5 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-6 overflow-y-scroll">
              @if(count(Auth::user()->notSettledPlan)>0 and Auth::user()->notSettledSumPlanIsHigh())
              <x-pay>Pagar Plan</x-pay>
              @endif
              @forelse(Auth::user()->allStudentPlan()->with('Training')->paginate(3) as $plan)
                <div class="flex justify-between items-center">
                  <div class="flex flex-col">
                    <a href="/students"> {{$plan->trainingPlan()}}</a>
                    <span class="text-xs text-primary-500">
                      {{$plan->Training->planClassComplete()}}
                    </span>
                    <span class="text-xs text-primary-500">
                      Inicio: {{ $plan->start_day()}}
                    </span>
                  </div>
                  @if($plan->isSettled())
                    <span class="text-green-500">Pagado</span>
                  @else
                    <span class="text-red-500">No Pagado {{$plan->trainingPrice()}}</span>
                  @endif
                </div>
              @empty
                <a href="/trainings" class="text-primary-500">Ver Planes de Entrenamiento</a>
              @endforelse
              {{Auth::user()->allStudentPlan()->with('Training')->paginate(3)->links()}}
            </div>
          </div>
        </div>

    </div>
  </x-landing.user-panel>
</x-landing.layout>
