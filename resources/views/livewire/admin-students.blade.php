<div class="grid grid-cols-1 mx-2">
    <div class="bg-white  p-4">
        <h1 class="admin-title-nav">
            Tabla Alumnos
        </h1>
    </div>

    <div class="mt-5 md:mt-0 md:col-span-3">
        <div class="shadow sm:rounded-md sm:overflow-hidden my-5">
            <div>
                <div class="bg-white shadow overflow-hidden sm:rounded-t-md">
                  <div class="border-t border-gray-200">
                    <dl>
                      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-6">
                        <dd class="text-sm font-medium text-gray-500">
                            <div class="col-span-4 sm:col-span-4">
                                <input type="text" name="user" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model="searchTermUser" placeholder="Buscar Usuario">
                            </div>
                            @if($this->users && $this->users->count() > 0)
                            <ul class="border border-gray-200 rounded overflow-hidden shadow-md col-span-6 absolute z-10">
                                @foreach($this->users as $user)
                                <li wire:click="selectUser({{$user->id}})" class="px-4 py-2 bg-white  hover:bg-primary-100 border-b last:border-none border-gray-200 transition-all duration-300 ease-in-out">
                                  {{$user->fullName()}} {{$user->rut}}
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </dd>
                        <dd class="text-sm font-medium text-gray-500">
                          <div class="col-span-4 sm:col-span-4">
                            <input type="text" name="user" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model="searchTermPlan" placeholder="Buscar Plan de Entrenamiento">
                          </div>
                          @if($this->trainings && $this->trainings->count() > 0)
                            <ul class="border border-gray-200 rounded overflow-hidden shadow-md col-span-6 absolute z-10">
                                @foreach($this->trainings as $training)
                                <li wire:click="selectPlan({{$training->id}})" class="px-4 py-2 bg-white  hover:bg-primary-100 border-b last:border-none border-gray-200 transition-all duration-300 ease-in-out">
                                  {{$training->planComplete()}}
                                </li>
                                @endforeach</ul>
                              @endif
                        </dd>
                        <dd class="text-sm font-medium text-gray-500">
                            <div class="col-span-4 sm:col-span-4">
                                <input type="date"  name="date" id="date" wire:model="date" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </dd>
                        <dd class="text-sm font-medium text-gray-500">
                            @if($this->user and $this->training and $date)
                                <span class="block text-center items-center py-2 mt-1.5 bg-primary-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-900 active:bg-primary-900 focus:outline-none focus:border-primary-900 focus:ring ring-primary-100 transition ease-in-out duration-150"
                                wire:click="addStudent({{$this->user->id}},{{$this->training->id}},'{{$date}}')">
                                    Crear
                                </span>
                            @else
                                <span class="block text-center items-center py-2 mt-1.5 bg-primary-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-900 active:bg-primary-900 focus:outline-none focus:border-primary-900 focus:ring ring-primary-100 transition ease-in-out duration-150"
                                    wire:click="addStudent(1,1,1)">
                                        Crear
                                </span>
                                {{-- <span class="block text-center items-center py-2 mt-1.5 bg-primary-100 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest  focus:ring ring-primary-100 disabled:opacity-25 transition ease-in-out duration-150 cursor-not-allowed">Crear</span> --}}
                            @endif
                        </dd>
                      </div>
                    </dl>
                  </div>
                </div>

            </div>
        </div>
    </div>

    <div class="w-full overflow-x-auto box-white px-10 py-2">
        <div class="w-full flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-600">Mes
                {{array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre")[$this->now->format('n')-1]}}
            </h2>
            <div class="border rounded-lg px-1" style="padding-top: 2px;" >
                <button
                    type="button"
                    class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 items-center"
                    wire:click="subPeriod"
                    >
                    <svg class="h-6 w-6 text-gray-500 inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <div class="border-r inline-flex h-6"></div>
                <button
                    type="button"
                    class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex items-center cursor-pointer hover:bg-gray-200 p-1"
                    wire:click="addPeriod"
                    >
                    <svg class="h-6 w-6 text-gray-500 inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 mx-2 mt-4">
    <livewire:student-table/>
</div>
