<div class="w-full order-1 sm:order-1 flex flex-col gap-4 h-full">
      <div class="bg-gray-50 shadow overflow-hidden sm:rounded-lg">
        <div class="flex px-4 py-5 sm:px-6 justify-between">
          <div class="flex justify-between w-full">
            <h3 class="text-2xl leading-2 font-medium text-primary-500">
              Nuestros servicios para el analisis de salud
            </h3>
          </div>
        </div>
      </div>
      @if($user->hasNutrition())
        <div class="h-auto bg-gray-50 shadow overflow-hidden sm:rounded-lg ">
          <div class="flex px-4 py-5 sm:px-6 justify-between">
            <div class="flex flex-col items-center">
                <select class="w-full bg-gray-200 border-gray-200 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" wire:model="nutritionID" id="nutritionID" name="nutritionID">
                Fecha
                  @foreach($user->nutrition()->orderby('Fecha','desc')->get() as $control)
                    <option value="{{$control->id}}">{{$control->fecha()}}</option>
                  @endforeach
              </select>
            </div>
            <div class="items-center">
                <a href="{{asset('pdf/tyc.pdf')}}" download>Descargar PDF <img src="{{$user->profilePic()}}" class="avatar h-12 w-12 ml-4"></a>
            </div>
          </div>
          <div class="border-t border-gray-200">
            <div class="bg-white text-sm px-4 py-5 grid sm:gap-4 sm:px-6">
                <span class="text-lg">Básicos</span>
                <div class="grid grid-cols-3 gap-x-4">
                    <div class="border p-3 flex">
                        <span class="text-base mr-4">Peso:</span>
                        <span class="text-base">{{$nutrition->peso}}</span>
                    </div>
                    <div class="border p-3 flex">
                        <span class="text-base mr-4">Talla / Estatura:</span>
                        <span class="text-base">{{$nutrition->talla_parado}}</span>
                    </div>
                    <div class="border p-3 flex">
                        <span class="text-base mr-4">Talla Sentado:</span>
                        <span class="text-base">{{$nutrition->talla_sentado}}</span>
                    </div>
                </div>
            </div>
            <div class="bg-white text-sm px-4 py-5 grid sm:gap-4 sm:px-6">
                <span class="text-lg text-center">Antrometría</span>
                <div class="grid grid-cols-2 gap-x-8 gap-y-4 mx-20">
                    <div class="w-auto">
                        <p class="py-2">Masa Adiposa</p>
                        <div class="grid grid-cols-2">
                            <div class="border text-base flex px-2 items-center">23.7%</div>
                            <div class="border text-base flex px-2 items-center">{{$nutrition->masa_adiposa}}</div>
                        </div>
                    </div>
                    <div class="w-auto">
                        <p class="py-2">Índice Músculo/Óseo</p>
                        <div class="grid grid-cols-2">
                            <div class="border text-base flex px-2 items-center">40.7%</div>
                            <div class="border text-base flex px-2 items-center">{{$nutrition->indice_musculo}}</div>
                        </div>
                    </div>
                    <div class="w-auto">
                        <p class="py-2">Masa Múscular</p>
                        <div class="grid grid-cols-2">
                            <div class="border text-base flex px-2 items-center">23.7%</div>
                            <div class="border text-base flex px-2 items-center">{{$nutrition->masa_muscular}}</div>
                        </div>
                    </div>
                    <div class="w-auto">
                        <p class="py-2">Índice Adiposo/Musc</p>
                        <div class="grid grid-cols-2">
                            <div class="border text-base flex px-2 items-center">23.7%</div>
                            <div class="border text-base flex px-2 items-center">{{$nutrition->indice_adiposo}}</div>
                        </div>
                    </div>
                    <div class="w-auto">
                        <p class="py-2">Masa Ósea</p>
                        <div class="grid grid-cols-2">
                            <div class="border text-base flex px-2 items-center">23.7%</div>
                            <div class="border text-base flex px-2 items-center">{{$nutrition->masa_osea}}</div>
                        </div>
                    </div>
                    <div class="w-auto">
                        <p class="py-2">Índice Masa Corporal</p>
                        <div class="grid grid-cols-2">
                            <div class="border text-base flex px-2 items-center">23.7%</div>
                            <div class="border text-base flex px-2 items-center">{{$nutrition->indice_corporal}}</div>
                        </div>
                    </div>
                </div>
                <section>
                    <div class="flex justify-center">
                        <a  href="#" class="bg-primary-500 hover:bg-primary-900 text-white text-base sm:text-xl font-bold rounded-lg text-center uppercase border-white border-2 py-2 mt-6 px-4">Referencias Antropometría</a>
                    </div>
                </section>
                <div class="bg-white text-sm px-4 py-5 grid sm:gap-4 sm:px-6">
                    <span class="text-lg text-center">Pliegues</span>
                    <div class="grid grid-cols-4 gap-4">
                        <div class="border p-3 flex">
                            <span class="text-base mr-4">Triceps:</span>
                            <span class="text-base">{{$nutrition->tricep}}</span>
                        </div>
                        <div class="border p-3 flex">
                            <span class="text-base mr-4">Bíceps:</span>
                            <span class="text-base">{{$nutrition->bicep}}</span>
                        </div>
                        <div class="border p-3 flex">
                            <span class="text-base mr-4">Muslo Medial:</span>
                            <span class="text-base">{{$nutrition->muslo_medial}}</span>
                        </div>
                        <div class="border p-3 flex">
                            <span class="text-base mr-4">Supraespinal:</span>
                            <span class="text-base">{{$nutrition->supraespinal}}</span>
                        </div>
                        <div class="border p-3 flex">
                            <span class="text-base mr-4">Subescapular:</span>
                            <span class="text-base">{{$nutrition->subescapular}}</span>
                        </div>
                        <div class="border p-3 flex">
                            <span class="text-base mr-4">Cresta Iliaca:</span>
                            <span class="text-base">{{$nutrition->cresta_iliaca}}</span>
                        </div>
                        <div class="border p-3 flex">
                            <span class="text-base mr-4">Pierna:</span>
                            <span class="text-base">{{$nutrition->pierna}}</span>
                        </div>
                        <div class="border p-3 flex">
                            <span class="text-base mr-4">Abdominal:</span>
                            <span class="text-base">{{$nutrition->abdominal}}</span>
                        </div>
                    </div>
                </div>
                {{-- <div class="flex justify-center"> --}}
                    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script> --}}

                {{-- <canvas id="myChart" style="width:100%;max-width:600px"></canvas>

                <script>
                    var xValues = ["Masa Ósea", "Masa Adiposa", "Masa Residual", "Masa Muscula"];
                    var yValues = [55, 49, 44, 24];
                    var barColors = [
                      "#b91d47",
                      "#00aba9",
                      "#2b5797",
                      "#e8c3b9"                    ];

                    new Chart("myChart", {
                      type: "pie",
                      data: {
                        labels: xValues,
                        datasets: [{
                          backgroundColor: barColors,
                          data: yValues
                        }]
                      },
                      options: {
                        title: {
                          display: true,
                          text: "Análisis Composición Corporal:"
                        }
                      }
                    });
                </script> --}}
                </div>
            </div>
            </div>
          </div>
        </div>
      @else
        <div class="w-full h-full gap-4">
          <div class="bg-gray-50 shadow overflow-hidden sm:rounded-lg ">
            <div class="bg-white text-base px-4 py-5 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-6 overflow-y-scroll">
              No tienes ningun control nutricional
            </div>
          </div>
        </div>
      @endif
    </div>
</div>
