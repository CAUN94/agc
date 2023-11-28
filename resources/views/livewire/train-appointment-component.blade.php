<div>
<div class="mt-5 md:mt-0 md:col-span-3">
    <div class="shadow sm:rounded-md sm:overflow-hidden my-5">
        <div>
            <div class="bg-white shadow overflow-hidden sm:rounded-t-md">
              <div class="border-t border-gray-200">
                <dl>
                  <div class="bg-white px-4 gap-10 sm:grid sm:grid-cols-1 sm:gap-6 sm:px-6 py-5">
                    <dd class="text-sm font-medium text-gray-500 py-1 sm:py-0">
                        <div class="col-span-4 sm:col-span-4">
                            <!-- select with live wire on select with $this->trainAppointments foreach -->
                            <select class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm" wire:change.prevent="selectTrainAppointment($event.target.value)">
                                <option value="">Seleccionar Clase</option>
                                @foreach($this->trainAppointments as $trainAppointment)
                                <option  wire.key="{{$trainAppointment->train_appointment_id}}" value="{{$trainAppointment->train_appointment_id}}"
                                >{{$trainAppointment->name}} - {{$trainAppointment->date}} - {{$trainAppointment->hour}}</option>
                                @endforeach
                            </select>
                           
                          
                        </div>
                    </dd>
                  </div>
                </dl>
              </div>
            </div>
            
        </div>
    </div>
    
</div>

@if($this->trainBooks)
  <div class="mt-5 md:mt-0">
    <div class="shadow sm:rounded-md sm:overflow-hidden my-5">
        <div>
            <div class="bg-white shadow overflow-hidden sm:rounded-t-md px-6 py-5">
              <div>
                  <div class="col-span-4 sm:col-span-4">
                    <input type="text" name="user" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model="searchTermStudent"  placeholder="Buscar Alumno">
                  </div>
                  @if($this->students && $this->students->count() > 0)
                  <ul class="border border-gray-200 rounded overflow-hidden shadow-md col-span-6 absolute z-10">
                      @foreach($this->students as $student)
                      <li wire:click="selectStudent({{$student->id}})" class="px-4 py-2 bg-white  hover:bg-primary-100 border-b last:border-none border-gray-200 transition-all duration-300 ease-in-out">
                        {{$student->full_name}}
                      </li>
                      @endforeach
                  </ul>
                  @endif
              </div>
                
            </div>
          </div>
      </div>
    </div>
    <div class="shadow sm:rounded-md sm:overflow-hidden my-5">
        <div>
            <div class="bg-white shadow overflow-hidden sm:rounded-t-md px-6 py-5">
              <div>
                  <ul>
                  @foreach($this->trainBooks as $trainBook)
                    <li>
                      {{$trainBook->user->name}}
                      {{$trainBook->user->lastnames}}
                      {{$trainBook->user->rut}}
                      <!-- Div Flex col with two span with wireclicks Asistio/No Asistio and spann with Borrar -->
                      @if($trainBook->status == 0)
                      <span class="text-primary-500" wire:click="status({{$trainBook->id}})">Asistio</span>
                      @else
                      <span class="text-red-500" wire:click="status({{$trainBook->id}})">No Asistio</span>
                      @endif
                      <span class="text-yellow-500" wire:click="delete({{$trainBook->id}})">Borrar</span>
                    </li>
                  @endforeach
                  </ul>
                
              </div>
            </div>
        </div>
    </div>
  </div>
@endif


</div>