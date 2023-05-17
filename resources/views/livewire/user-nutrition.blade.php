<div class="w-full order-1 sm:order-1 flex flex-col gap-4 h-full">
      <div class="bg-gray-50 shadow overflow-hidden sm:rounded-lg">
        <div class="flex px-4 py-5 sm:px-6 justify-between">
          <div class="flex justify-between w-full">
            <h3 class="text-base sm:text-2xl leading-2 font-medium text-primary-500">
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
                <a wire:click="descargarPDF('{{$nutrition->fecha}}','{{$user->rut}}')" download>Descargar PDF <img src="{{$user->profilePic()}}" class="avatar h-10 w-10 sm:h-12 sm:w-12 ml-4"></a>
            </div>
          </div>

          <div class="bg-white flex justify-center">
              <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

         <canvas id="myChart" style="width:100%;max-width:450px"></canvas>

         <script>
             var xValues = ["Masa Muscular", "Masa Adiposa", "Masa Ósea", "Masa Residual"];
             var yValues = [{{$nutrition->masa_muscular}}, {{$nutrition->masa_adiposa}}, {{$nutrition->masa_osea}}, {{$nutrition->masa_piel+$nutrition->masa_residual}}];
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
         </script>
         <canvas id="graficoAdiposo" style="width:100%;max-width:450px"></canvas>

         <script>
         var xValues = JSON.parse('<?php echo $user->nutrition()->orderby('Fecha','desc')->pluck('Fecha');?>');
         var yValues = JSON.parse('<?php echo $user->nutrition()->orderby('Fecha','desc')->pluck('masa_adiposa');?>');

             new Chart("graficoAdiposo", {
               type: "line",
               data: {
                 labels: xValues,
                 datasets: [{
                   label: 'masa Adiposa',
                   backgroundColor: "white",
                   borderColor: "#00aba9",
                   data: yValues
                 }]
               },
               options: {
                 title: {
                   display: true,
                   text: "Masa Adiposa:"
                 }
               }
             });
         </script>
         <canvas id="graficoMuscular" style="width:100%;max-width:450px"></canvas>

         <script>
         var xValues = JSON.parse('<?php echo $user->nutrition()->orderby('Fecha','desc')->pluck('Fecha');?>');
         var yValues = JSON.parse('<?php echo $user->nutrition()->orderby('Fecha','desc')->pluck('masa_muscular');?>');

             new Chart("graficoMuscular", {
               type: "line",
               data: {
                 labels: xValues,
                 datasets: [{
                   label: 'masa Muscular',
                   backgroundColor: "white",
                   borderColor: "#b91d47",
                   data: yValues
                 }]
               },
               options: {
                 title: {
                   display: true,
                   text: "Masa Muscular:"
                 }
               }
             });
         </script>
         </div>

          <div class="border-t border-gray-200">
            <div class="bg-white text-sm px-4 py-5 grid sm:gap-4 sm:px-6">
                <span class="text-lg">Básicos</span>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-x-4">
                    <div class="border p-3 flex">
                        <span class="text-base mr-4">Peso:</span>
                        <span class="text-base">{{$nutrition->peso}} Kg</span>
                    </div>
                    <div class="border p-3 flex">
                        <span class="text-base mr-4">Talla / Estatura:</span>
                        <span class="text-base">{{$nutrition->talla_parado}} cm</span>
                    </div>
                    <div class="border p-3 flex">
                        <span class="text-base mr-4">Talla Sentado:</span>
                        <span class="text-base">{{$nutrition->talla_sentado}} cm</span>
                    </div>
                </div>
            </div>

            <div class="bg-white text-sm px-4 py-5 grid sm:gap-4 sm:px-6">
                <span class="text-lg text-center">Antrometría</span>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-x-8 gap-y-4 mx-10 sm:mx-20">
                    <div class="w-auto">
                        <p class="py-2">Masa Adiposa</p>
                        <div class="grid grid-cols-3">
                            <div class="border text-base flex px-2 items-center">{{round(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100, 1)}}%</div>
                            <div class="border text-base flex px-2 items-center">{{$nutrition->masa_adiposa}} Kg</div>
                            <div class="border text-base flex px-2 items-center">-3.2 Kg</div>
                        </div>
                    </div>
                    <div class="items-center">
                        <p class="py-2">Índice Músculo/Óseo</p>
                        <div class="grid grid-cols-2">
                            <div class="border text-base flex px-2 items-center">{{$nutrition->indice_musculo}} </div>

                        </div>
                    </div>
                    <div class="items-center">
                        <p class="py-2">Índice Adiposo/Musc</p>
                        <div class="grid grid-cols-2">
                            <div class="border text-base flex px-2 items-center">{{$nutrition->indice_adiposo}}</div>
                        </div>
                    </div>
                    <div class="w-auto">
                        <p class="py-2">Masa Múscular</p>
                        <div class="grid grid-cols-3">
                            <div class="border text-base flex px-2 items-center">{{round(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100, 1)}}%</div>
                            <div class="border text-base flex px-2 items-center">{{$nutrition->masa_muscular}} Kg</div>
                            <div class="border text-base flex px-2 items-center"> +1.6 Kg</div>
                        </div>
                    </div>
                    <div class="w-auto">
                        <p class="py-2">Índice Masa Corporal</p>
                        <div class="grid grid-cols-2">
                            <div class="border text-base flex px-2 items-center">{{$nutrition->indice_corporal}} Kg/m2</div>
                        </div>
                    </div>
                    <div class="w-auto">
                        <p class="py-2">Sumatoria de 6 Plieges</p>
                        <div class="grid grid-cols-2">
                            <div class="border text-base flex px-2 items-center">{{($nutrition->tricep + $nutrition->subescapular + $nutrition->supraespinal + $nutrition->abdominal + $nutrition->muslo_medial +  $nutrition->pierna_mm)}} mm</div>
                        </div>
                    </div>
                    <div class="w-auto">
                        <p class="py-2">Masa Ósea</p>
                        <div class="grid grid-cols-3">
                            <div class="border text-base flex px-2 items-center">{{round(($nutrition->masa_osea/$nutrition->peso_estructurado)*100, 1)}}%</div>
                            <div class="border text-base flex px-2 items-center">{{$nutrition->masa_osea}} Kg</div>
                            <div class="border text-base flex px-2 items-center">---</div>
                        </div>
                    </div>
                </div>
                <section>
                    <div class="flex justify-center">
                        <a  href="#" class="bg-primary-500 hover:bg-primary-900 text-white text-base sm:text-xl font-bold rounded-lg text-center uppercase border-white border-2 py-2 mt-6 px-4">Referencias Antropometría</a>
                    </div>
                </section>
                <div class="bg-white text-sm px-4 py-5 grid sm:gap-4 sm:px-6">
                    <span class="text-lg text-center">Perimetros</span>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <div class="border p-3 flex">
                            <span class="text-base mr-4">Brazo Relajado:</span>
                            <span class="text-base">{{$nutrition->brazo_r}} cm</span>
                        </div>
                        <div class="border p-3 flex">
                            <span class="text-base mr-4">Brazo Flexionado:</span>
                            <span class="text-base">{{$nutrition->brazo_flex}} cm</span>
                        </div>
                        <div class="border p-3 flex">
                            <span class="text-base mr-4">Antebrazo Máximo:</span>
                            <span class="text-base">{{$nutrition->antebrazo_max}} cm</span>
                        </div>
                        <div class="border p-3 flex">
                            <span class="text-base mr-4">Tórax:</span>
                            <span class="text-base">{{$nutrition->torax_meso}} cm</span>
                        </div>
                        <div class="border p-3 flex">
                            <span class="text-base mr-4">Cintura:</span>
                            <span class="text-base">{{$nutrition->cintura}} cm</span>
                        </div>
                        <div class="border p-3 flex">
                            <span class="text-base mr-4">Cadera Máximo:</span>
                            <span class="text-base">{{$nutrition->cadera}} cm</span>
                        </div>
                        <div class="border p-3 flex">
                            <span class="text-base mr-4">Muslo Máximo:</span>
                            <span class="text-base">{{$nutrition->muslo_max}} cm</span>
                        </div>
                        <div class="border p-3 flex">
                            <span class="text-base mr-4">Muslo Medio:</span>
                            <span class="text-base">{{$nutrition->muslo_medio}} cm</span>
                        </div>
                        <div class="border p-3 flex">
                            <span class="text-base mr-4">Pierna:</span>
                            <span class="text-base">{{$nutrition->pierna_cm}} cm</span>
                        </div>
                    </div>
                </div>
                <div class="bg-white text-sm px-4 py-5 grid sm:gap-4 sm:px-6">
                    <span class="text-lg text-center">Pliegues</span>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <div class="border p-3 flex">
                            <span class="text-base mr-4">Triceps:</span>
                            <span class="text-base">{{$nutrition->tricep}} mm</span>
                        </div>
                        <div class="border p-3 flex">
                            <span class="text-base mr-4">Bíceps:</span>
                            <span class="text-base">{{$nutrition->biceps}} mm</span>
                        </div>
                        <div class="border p-3 flex">
                            <span class="text-base mr-4">Muslo Medial:</span>
                            <span class="text-base">{{$nutrition->muslo_medial}} mm</span>
                        </div>
                        <div class="border p-3 flex">
                            <span class="text-base mr-4">Supraespinal:</span>
                            <span class="text-base">{{$nutrition->supraespinal}} mm</span>
                        </div>
                        <div class="border p-3 flex">
                            <span class="text-base mr-4">Subescapular:</span>
                            <span class="text-base">{{$nutrition->subescapular}} mm</span>
                        </div>
                        <div class="border p-3 flex">
                            <span class="text-base mr-4">Cresta Iliaca:</span>
                            <span class="text-base">{{$nutrition->cresta_iliaca}} mm</span>
                        </div>
                        <div class="border p-3 flex">
                            <span class="text-base mr-4">Pierna:</span>
                            <span class="text-base">{{$nutrition->pierna_mm}} mm</span>
                        </div>
                        <div class="border p-3 flex">
                            <span class="text-base mr-4">Abdominal:</span>
                            <span class="text-base">{{$nutrition->abdominal}} mm</span>
                        </div>
                    </div>
                </div>
                <div class="bg-white text-sm px-4 py-5 grid sm:gap-4 sm:px-6">
                    <span class="text-lg text-center">Diagnostico Nutricional</span>
                        <div class="border p-3 flex">
                            <span class="text-base mr-4">Dentro de los objetivos se buscara obtener una reducción de masa adiposa (-5 kg), y así se
mejorara el índice adiposo muscular, el índice músculo óseo y la sumatoria de 6 pliegues. La
masa muscular debe preservarse en este periodo, para luego aumentar de manera
progresiva (+2 kg)</span>
                        </div>
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
