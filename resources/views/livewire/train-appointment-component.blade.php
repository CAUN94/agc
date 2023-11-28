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
                                  {{$user->full_name}}
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </dd>
                      </div>
                    </dl>
                  </div>
                </div>

            </div>
        </div>
</div>

<div class="mt-5 md_mt-0">
    @foreach($this->trainAppointments as $trainAppointment)
      {{$trainAppointment->name}} {{$trainAppointment->date}} {{$trainAppointment->hour}}<br>
    @endforeach
</div>

