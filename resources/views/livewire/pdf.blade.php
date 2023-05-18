<style>

table{
  border-collapse: collapse;
}

th, td{
  border: solid 1px black;
}

td{
  text-align: right;
}

th{
  background-color: lightsalmon;
}

</style>

<body style="font-family: Arial, Helvetica, sans-serif;">
  <img class="logo" src="https://yjb.cl/img/logo.png" style="width: 160px; height: 100px; position: absolute; right: 0;">
  <h1 style= "text-align: center">Evaluación Nutricional</h1>
  <p>
    <span style= "text-align: center">Nombre: {{$nutrition->plan}}</span>
  </p>
  <span style= "text-align: right">Fecha: {{Carbon\Carbon::parse($nutrition->fecha)->format('d-m-Y')}}</span>
  <p class='text-center bold'>Edad: {{$nutrition->edad}}</p>

  <div style="clear:both; position:relative;">
    <div style="position:absolute; left:0pt; width:192pt;">
      <table class="table-fixed w-full overflow-hidden rounded-lg shadow-lg p-6">
        <thead class="cabecera">
          <tr class="bg-gray-300 text-sm font-semibold tracking-wide text-left">
            <th class="text-center py-2 min-w-4/8 w-6/12">Básicos</th>
            <th class="text-center py-2 min-w-4/8 w-6/12 ">Datos</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center">Peso (kg)</td>
            <td>{{$nutrition->peso}}</td>
          </tr>
          <tr>
            <td class="text-center">Talla (cm)</td>
            <td>{{$nutrition->talla_parado}}</td>
          </tr>
          <tr>
            <td>Talla sentado (cm)</td>
            <td>{{$nutrition->talla_sentado}}</td>
          </tr>
          <tr>
            <td style="background-color: lightsalmon; text-align: center; font-weight: bold;">Diametros</td>
            <td style="background-color: lightsalmon;"></td>
          </tr>
          <tr>
            <td class="text-center">Biacromial</td>
            <td class= "datos">{{$nutrition->biacromial}}</td>
          </tr>
          <tr>
            <td class="text-center">Tórax Transverso</td>
            <td class="datos">{{$nutrition->torax_t}}</td>
          </tr>
          <tr>
            <td class="text-center">Tórax Anteropost</td>
            <td class="datos">{{$nutrition->torax_ap}}</td>
          </tr>
          <tr>
            <td class="text-center">Bi-iliocrestídeo</td>
            <td class="datos">{{$nutrition->iliocrestideo}}</td>
          </tr>
          <tr>
            <td class="text-center">Humeral</td>
            <td class="datos">{{$nutrition->humeral}}</td>
          </tr>
          <tr>
            <td class="text-center">Femoral</td>
            <td class="datos">{{$nutrition->femoral}}</td>
          </tr>

          <tr>
            <td style="background-color: lightsalmon; text-align: center; font-weight: bold;">Perimetros (cm)</td>
            <td style="background-color: lightsalmon;"></td>
          </tr>
          <tr>
            <td class="text-center">Cabeza</td>
            <td class="text-center">{{$nutrition->cabeza}}</td>
          </tr>
          <tr>
            <td class="text-center">Brazo relajado</td>
            <td class="text-center">{{$nutrition->brazo_r}}</td>
          </tr>
          <tr>
            <td class="text-center">Brazo flexionado</td>
            <td class="text-center">{{$nutrition->brazo_flex}}</td>
          </tr>
          <tr>
            <td class="text-center">Antebrazo máximo</td>
            <td class="text-center">{{$nutrition->antebrazo_max}}</td>
          </tr>
          <tr>
            <td class="text-center">Tórax</td>
            <td class="text-center">{{$nutrition->torax_meso}}</td>
          </tr>
          <tr>
            <td class="text-center">Cintura</td>
            <td class="text-center">{{$nutrition->cintura}}</td>
          </tr>
          <tr>
            <td class="text-center">Cadera máximo</td>
            <td class="text-center">{{$nutrition->cadera}}</td>
          </tr>
          <tr>
            <td class="text-center">Muslo máximo</td>
            <td class="text-center">{{$nutrition->muslo_max}}</td>
          </tr>
          <tr>
            <td class="text-center">Muslo medio</td>
            <td class="text-center">{{$nutrition->muslo_medio}}</td>
          </tr>
          <tr>
            <td class="text-center">Pierna</td>
            <td class="text-center">{{$nutrition->pierna_cm}}</td>
          </tr>

          <tr>
            <td style="background-color: lightsalmon; text-align: center; font-weight: bold;">Pliegues (mm)</td>
            <td style="background-color: lightsalmon;"></td>
          </tr>
          <tr>
            <td class="text-center">Tríceps</td>
            <td class="text-center">{{$nutrition->tricep}}</td>
          </tr>

          <tr>
            <td class="text-center">Subescapular</td>
            <td class="text-center">{{$nutrition->subescapular}}</td>
          </tr>

          <tr>
            <td class="text-center">Bíceps</td>
            <td class="text-center">{{$nutrition->biceps}}</td>
          </tr>

          <tr>
            <td class="text-center">Cresta iliaca</td>
            <td class="text-center">{{$nutrition->cresta_iliaca}}</td>
          </tr>

          <tr>
            <td class="text-center">Supraespinal</td>
            <td class="text-center">{{$nutrition->supraespinal}}</td>
          </tr>

          <tr>
            <td class="text-center">Abdominal</td>
            <td class="text-center">{{$nutrition->abdominal}}</td>
          </tr>

          <tr>
            <td class="text-center">Muslo medial</td>
            <td class="text-center">{{$nutrition->muslo_medial}}</td>
          </tr>

          <tr>
            <td class="text-center">Pierna</td>
            <td class="text-center">{{$nutrition->pierna_mm}}</td>
          </tr>
        </tbody>
      </table>
      </div>

      <div style="margin-left:160pt;">
        <h4>Resultados Antropometría:</h4>
        <table>
          <thead>
            <tr>
              <th>Composición Corporal</th>
              <th colspan="2">Valor</th>
              <th>Clasificación</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="text-align: left;">Masa Adiposa</td>
              <td style="text-align: center;">{{$nutrition->masa_adiposa}} kg</td>
              <td style="text-align: center;">{{round(($nutrition->masa_adiposa_porc)*100, 0)}}%  </td>
              <td style="text-align: center;">
                @if($nutrition->gender == 'f')
                  @if($nutrition->habito == 'D')
                    @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 21)
                      Excelente
                    @endif
                    @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 >= 21.1  && ($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 24)
                      Bueno
                    @endif
                    @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 >= 24.1  && ($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 29)
                      Aceptable
                    @endif
                    @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 >= 29.1  && ($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 34)
                      Elevado
                    @endif
                    @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 > 34)
                      Muy Elevado
                    @endif
                  @else
                    @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 26)
                      Excelente
                    @endif
                    @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 >= 26.1  && ($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 28)
                      Bueno
                    @endif
                    @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 >= 28.1  && ($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 30)
                      Aceptable
                    @endif
                    @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 >= 30.1  && ($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 36)
                      Elevado
                    @endif
                    @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 > 36)
                      Muy Elevado
                    @endif
                  @endif
                @else
                  @if($nutrition->habito == 'D')
                    @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 16.5)
                      Excelente
                    @endif
                    @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 >= 16.6  && ($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 20)
                      Bueno
                    @endif
                    @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 >= 20.1  && ($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 26)
                      Aceptable
                    @endif
                    @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 >= 26.1  && ($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 30.6)
                      Elevado
                    @endif
                    @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 > 30.6)
                      Muy Elevado
                    @endif
                  @else
                    @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 18.9)
                      Excelente
                    @endif
                    @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 >= 19.1  && ($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 23.1)
                      Bueno
                    @endif
                    @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 >= 23.2  && ($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 27.5)
                      Aceptable
                    @endif
                    @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 >= 27.6  && ($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 33)
                      Elevado
                    @endif
                    @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 > 33)
                      Muy Elevado
                    @endif
                  @endif
                @endif
              </td>
            </tr>

            <tr>
              <td style="text-align: left;">Masa Muscular</td>
              <td style="text-align: center;">{{$nutrition->masa_muscular}}kg</td>
              <td style="text-align: center;">{{round(($nutrition->masa_muscular_porc)*100, 0)}}%</td>
              <td style="text-align: center;">
                @if($nutrition->gender == 'f')
                  @if($nutrition->habito == 'D')
                    @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 > 47.5)
                      Excelente
                    @endif
                    @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 >= 43.9  && ($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 <= 47.5)
                      Bueno
                    @endif
                    @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 >= 36.4  && ($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 < 43.9)
                      Aceptable
                    @endif
                    @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 >= 32.7  && ($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 < 36.4)
                      Bajo
                    @endif
                    @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 < 32.7)
                      Muy Bajo
                    @endif
                  @else
                    @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 > 45.2)
                      Excelente
                    @endif
                    @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 >= 41  && ($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 <= 45.2)
                      Bueno
                    @endif
                    @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 >= 32.3  && ($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 < 41)
                      Aceptable
                    @endif
                    @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 >= 28  && ($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 < 32.3)
                      Bajo
                    @endif
                    @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 < 28)
                      Muy Bajo
                    @endif
                  @endif
                @else
                  @if($nutrition->habito == 'D')
                    @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 > 54.2)
                      Excelente
                    @endif
                    @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 >= 50.8  && ($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 <= 54.2)
                      Bueno
                    @endif
                    @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 >= 44  && ($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 < 50.8)
                      Aceptable
                    @endif
                    @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 >= 40.6  && ($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 < 44)
                      Bajo
                    @endif
                    @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 < 40.6)
                      Muy Bajo
                    @endif
                  @else
                    @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 > 50.7)
                      Excelente
                    @endif
                    @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 >= 47.4  && ($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 <= 50.7)
                      Bueno
                    @endif
                    @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 >= 40.5  && ($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 < 47.3)
                      Aceptable
                    @endif
                    @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 >= 37.1  && ($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 < 40.5)
                      Bajo
                    @endif
                    @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 < 37.1)
                      Muy Bajo
                    @endif
                  @endif
                @endif
              </td>
            </tr>

            <tr>
              <td style="text-align: left;">Masa Osea</td>
              <td style="text-align: center;">{{$nutrition->masa_osea}} kg</td>
              <td style="text-align: center;">{{round(($nutrition->masa_osea_porc)*100, 0)}}%</td>
              <td style="text-align: center;">---</td>
            </tr>

            <tr>
              <td style="text-align: left;">Indice músculo/óseo:</td>
              <td style="text-align: center;">{{$nutrition->indice_musculo}}</td>
              <td style="text-align: center;">-</td>
              <td style="text-align: center;">
                @if($nutrition->gender == 'f')
                  @if($nutrition->indice_musculo > 4.3)
                    Excelente
                  @endif
                  @if($nutrition->indice_musculo >= 3.91  && $nutrition->indice_musculo <= 4.3)
                    Bueno
                  @endif
                  @if($nutrition->indice_musculo >= 3.51  && $nutrition->indice_musculo < 3.91)
                    Aceptable
                  @endif
                  @if($nutrition->indice_musculo >= 3.1  && $nutrition->indice_musculo < 3.51)
                    Bajo
                  @endif
                  @if($nutrition->indice_musculo < 3.1)
                    Muy Bajo
                  @endif
                @else
                  @if($nutrition->indice_musculo > 4.6)
                    Excelente
                  @endif
                  @if($nutrition->indice_musculo >= 4.21  && $nutrition->indice_musculo <= 4.6)
                    Bueno
                  @endif
                  @if($nutrition->indice_musculo >= 3.81  && $nutrition->indice_musculo < 4.21)
                    Aceptable
                  @endif
                  @if($nutrition->indice_musculo >= 3.5  && $nutrition->indice_musculo < 3.81)
                    Bajo
                  @endif
                  @if($nutrition->indice_musculo < 3.5)
                    Muy Bajo
                  @endif
                @endif
              </td>
            </tr>

            <tr>
              <td style="text-align: left;">Indice adiposo/muscular</td>
              <td style="text-align: center;">{{$nutrition->indice_adiposo}}</td>
              <td style="text-align: center;">-</td>
              <td style="text-align: center;">
                @if($nutrition->gender == 'f')
                  @if($nutrition->indice_adiposo < 0.55)
                    Excelente
                  @endif
                  @if($nutrition->indice_adiposo >= 0.55  && $nutrition->indice_adiposo < 0.7)
                    Bueno
                  @endif
                  @if($nutrition->indice_adiposo >= 0.7  && $nutrition->indice_adiposo < 0.88)
                    Aceptable
                  @endif
                  @if($nutrition->indice_adiposo >= 0.88  && $nutrition->indice_adiposo < 1.06)
                    Elevado
                  @endif
                  @if($nutrition->indice_adiposo >= 1.06)
                    Muy Elevado
                  @endif
                @else
                  @if($nutrition->indice_adiposo < 0.36)
                    Excelente
                  @endif
                  @if($nutrition->indice_adiposo >= 0.36  && $nutrition->indice_adiposo < 0.41)
                    Bueno
                  @endif
                  @if($nutrition->indice_adiposo >= 0.42  && $nutrition->indice_adiposo < 0.54)
                    Aceptable
                  @endif
                  @if($nutrition->indice_adiposo >= 0.54  && $nutrition->indice_adiposo < 0.65)
                    Elevado
                  @endif
                  @if($nutrition->indice_adiposo >= 0.65)
                    Muy Elevado
                  @endif
                @endif
              </td>
            </tr>

            <tr>
              <td style="text-align: left;">Indice masa corporal</td>
              <td style="text-align: center;">{{$nutrition->indice_corporal}} Kg/m2</td>
              <td style="text-align: center;">-</td>
              <td style="text-align: center;">
                @if($nutrition->indice_corporal < 18.5)
                  Bajo
                @elseif(24.9 < $nutrition->indice_corporal)
                  Alto
                @else
                  Normal
                @endif
              </td>
            </tr>

            <tr>
              <td style="text-align: left;">Somatotipo</td>
              <td style="text-align: center;">{{round($nutrition->endo, 1)}} {{round($nutrition->meso, 1)}} {{round($nutrition->ecto, 1)}}</td>
              <td style="text-align: center;">-</td>
              <td style="text-align: center;">
                @if((round($nutrition->endo, 1) >= round($nutrition->meso, 1)) && (round($nutrition->endo, 1) >= round($nutrition->ecto, 1)))
                  Endomorfo
                @elseif((round($nutrition->meso, 1) >= round($nutrition->endo, 1)) && (round($nutrition->meso, 1) >= round($nutrition->ecto, 1)))
                  Mesomorfo
                @else
                  Ectomorfo
                @endif
              </td>
            </tr>

            <tr>
              <td style="text-align: left;">Sumatoria 6 plieges</td>
              <td class="text-center">{{($nutrition->tricep + $nutrition->subescapular + $nutrition->supraespinal + $nutrition->abdominal + $nutrition->muslo_medial +  $nutrition->pierna_mm)}} mm</td>
              <td style="text-align: center;">-</td>
              <td style="text-align: center;">
                @if (($nutrition->tricep + $nutrition->subescapular + $nutrition->supraespinal + $nutrition->abdominal + $nutrition->muslo_medial +  $nutrition->pierna_mm) > App\Models\NutritionSport::where('descripcion','=',$nutrition->deporte)->value('sumatoria_6_plieges'))
                  Alto
                @else
                  Bien
                @endif
              </td>
            </tr>

          </tbody>
        </table>

      <h4>Referencias Antropometría:</h4>
      <table class="table-fixed w-full overflow-hidden rounded-lg shadow-lg p-6">
        <thead>
          <tr class="bg-gray-300 text-sm font-semibold tracking-wide text-left">
            <th class="text-center py-2 min-w-4/8 w-6/12">Composición corporal</th>
            <th style="text-align: center;">Valor Aceptable</th>
            <th style="text-align: center;">Valor Bueno</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="text-align: left;">Masa Adiposa</td>
            <td style="text-align: center;">
              @if($nutrition->gender == 'f')
                @if($nutrition->habito == 'D')
                  24.1 - 29 %
                @else
                  28.1 - 30 %
                @endif
              @else
                @if($nutrition->habito == 'D')
                  20.1 - 26 %
                @else
                  23.2 - 27.5 %
                @endif
              @endif
            </td>
            <td style="text-align: center;">
              @if($nutrition->gender == 'f')
                @if($nutrition->habito == 'D')
                  21.1 - 24 %
                @else
                  26.1 - 28 %
                @endif
              @else
                @if($nutrition->habito == 'D')
                  16.6 - 20 %
                @else
                  19 - 23.1 %
                @endif
              @endif
            </td>
          </tr>
          <tr>
            <td style="text-align: left;">Masa Muscular</td>
            <td style="text-align: center;">
              @if($nutrition->gender == 'f')
                @if($nutrition->habito == 'D')
                  36.4 - 43.8 %
                @else
                  32.3 - 40.9 %
                @endif
              @else
                @if($nutrition->habito == 'D')
                  44 - 50.7 %
                @else
                  40.5 - 47.3 %
                @endif
              @endif
            </td>
            <td style="text-align: center;">
              @if($nutrition->gender == 'f')
                @if($nutrition->habito == 'D')
                  42.9 - 47.5 %
                @else
                  41 - 45.2 %
                @endif
              @else
                @if($nutrition->habito == 'D')
                  50.8 - 54.2 %
                @else
                  47.4 - 50.7 %
                @endif
              @endif
            </td>
          </tr>
          <tr>
            <td style="text-align: left;">Indice músculo/óseo</td>
            <td style="text-align: center;">
              @if($nutrition->gender == 'f')
                3.51 - 3.9
              @else
                3.81 - 4.2
              @endif
            </td>
            <td style="text-align: center;">
              @if($nutrition->gender == 'f')
                3.91 - 4.3
              @else
                4.21 - 4.6
              @endif
            </td>
          </tr>
          <tr>
            <td style="text-align: left;">Indice adiposo/musc</td>
            <td style="text-align: center;">
              @if($nutrition->gender == 'f')
                0.71 - 0.88
              @else
                0.42 - 0.54
              @endif
            </td>
            <td style="text-align: center;">
              @if($nutrition->gender == 'f')
                0.54 -  0.7
              @else
                0.36 - 0.41
              @endif
            </td>
          </tr>
          <tr>
            <td style="text-align: left;">Indice masa corporal</td>
            <td style="text-align: center;">18.5 - 24.9 Kg/m2</td>
            <td style="text-align: center;">---</td>
          </tr>
          <tr>
            <td style="text-align: left;">Sumatoria 6 pliegues</td>
            <td style="text-align: center;"> {{App\Models\NutritionSport::where('descripcion','=',$nutrition->deporte)->value('sumatoria_6_plieges')}}</td>
            <td style="text-align: center;">-</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div>
    <div style="margin-left:160pt;">
      <h4 >Análisis:</h4>
      <p>La masa adiposa está en
        @if($nutrition->gender == 'f')
          @if($nutrition->habito == 'D')
            @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 21)
              rangos excelentes
            @endif
            @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 >= 21.1  && ($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 24)
              buenos rangos
            @endif
            @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 >= 24.1  && ($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 29)
              rangos aceptables
            @endif
            @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 >= 29.1  && ($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 34)
              rangos elevados
            @endif
            @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 > 34)
              rangos muy elevados
            @endif
          @else
            @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 26)
              rangos excelentes
            @endif
            @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 >= 26.1  && ($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 28)
              buenos rangos
            @endif
            @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 >= 28.1  && ($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 30)
              rangos aceptables
            @endif
            @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 >= 30.1  && ($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 36)
              rangos elevados
            @endif
            @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 > 36)
              rangos muy elevados
            @endif
          @endif
        @else
          @if($nutrition->habito == 'D')
            @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 16.5)
              rangos excelentes
            @endif
            @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 >= 16.6  && ($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 20)
              buenos rangos
            @endif
            @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 >= 20.1  && ($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 26)
              rangos aceptables
            @endif
            @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 >= 26.1  && ($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 30.6)
              rangos elevados
            @endif
            @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 > 30.6)
              rangos muy elevados
            @endif
          @else
            @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 18.9)
              rangos excelentes
            @endif
            @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 >= 19.1  && ($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 23.1)
              buenos rangos
            @endif
            @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 >= 23.2  && ($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 27.5)
              rangos aceptables
            @endif
            @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 >= 27.6  && ($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 <= 33)
              rangos elevados
            @endif
            @if(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100 > 33)
              rangos muy elevados
            @endif
          @endif
        @endif según porcentaje.</p>
      <p>La masa muscular se encuentra en @if($nutrition->gender == 'f')
        @if($nutrition->habito == 'D')
          @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 > 47.5)
            rangos excelentes
          @endif
          @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 >= 43.9  && ($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 <= 47.5)
            buenos rangos
          @endif
          @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 >= 36.4  && ($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 < 43.9)
            rangos aceptables
          @endif
          @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 >= 32.7  && ($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 < 36.4)
            rangos bajos
          @endif
          @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 < 32.7)
            rangos muy bajos
          @endif
        @else
          @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 > 45.2)
            rangos excelentes
          @endif
          @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 >= 41  && ($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 <= 45.2)
            buenos rangos
          @endif
          @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 >= 32.3  && ($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 < 41)
            rangos aceptables
          @endif
          @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 >= 28  && ($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 < 32.3)
            rangos bajos
          @endif
          @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 < 28)
            rangos muy bajos
          @endif
        @endif
      @else
        @if($nutrition->habito == 'D')
          @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 > 54.2)
            rangos excelentes
          @endif
          @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 >= 50.8  && ($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 <= 54.2)
            buenos rangos
          @endif
          @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 >= 44  && ($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 < 50.8)
            rangos aceptables
          @endif
          @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 >= 40.6  && ($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 < 44)
            rangos bajos
          @endif
          @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 < 40.6)
            rangos muy bajos
          @endif
        @else
          @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 > 50.7)
            rangos excelentes
          @endif
          @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 >= 47.4  && ($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 <= 50.7)
            buenos rangos
          @endif
          @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 >= 40.5  && ($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 < 47.3)
            rangos aceptables
          @endif
          @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 >= 37.1  && ($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 < 40.5)
            rangos bajos
          @endif
          @if(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100 < 37.1)
            rangos muy bajos
          @endif
        @endif
      @endif.</p>

      <table class="table-fixed w-full overflow-hidden rounded-lg shadow-lg p-6">
        <thead>
          <tr class="bg-gray-300 text-sm font-semibold tracking-wide text-left">
            <th class="text-center py-2 min-w-4/8 w-6/12">Composición corporal</th>
            <th style="text-align: center;">Porcentaje</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="text-align: left;">Masa Adiposa</td>
            <td style="text-align: center;">{{round(($nutrition->masa_adiposa/$nutrition->peso_estructurado)*100, 0)}}%</td>
          </tr>
          <tr>
            <td style="text-align: left;">Masa Múscular</td>
            <td style="text-align: center;">{{round(($nutrition->masa_muscular/$nutrition->peso_estructurado)*100, 0)}}%</td>
          </tr>
          <tr>
            <td style="text-align: left;">Masa Ósea</td>
            <td style="text-align: center;">{{round(($nutrition->masa_osea/$nutrition->peso_estructurado)*100, 0)}}%</td>
          </tr>
          <tr>
            <td style="text-align: left;">Masa Residual</td>
            <td style="text-align: center;">{{round(($nutrition->masa_residual/$nutrition->peso_estructurado)*100, 0)}}%</td>
          </tr>
          <tr>
            <td style="text-align: left;">Masa Piel</td>
            <td style="text-align: center;">{{round(($nutrition->masa_piel/$nutrition->peso_estructurado)*100, 0)}}%</td>
          </tr>
        </tbody>
      </table>
    </div>

    <p>Según su índice músculo/óseo este se encuentra @if($nutrition->gender == 'f')
      @if($nutrition->indice_musculo > 4.3)
        excelente
      @endif
      @if($nutrition->indice_musculo >= 3.91  && $nutrition->indice_musculo <= 4.3)
        bueno
      @endif
      @if($nutrition->indice_musculo >= 3.51  && $nutrition->indice_musculo < 3.91)
        aceptable
      @endif
      @if($nutrition->indice_musculo >= 3.1  && $nutrition->indice_musculo < 3.51)
        bajo
      @endif
      @if($nutrition->indice_musculo < 3.1)
        muy bajo
      @endif
    @else
      @if($nutrition->indice_musculo > 4.6)
        excelente
      @endif
      @if($nutrition->indice_musculo >= 4.21  && $nutrition->indice_musculo <= 4.6)
        bueno
      @endif
      @if($nutrition->indice_musculo >= 3.81  && $nutrition->indice_musculo < 4.21)
        aceptable
      @endif
      @if($nutrition->indice_musculo >= 3.5  && $nutrition->indice_musculo < 3.81)
        bajo
      @endif
      @if($nutrition->indice_musculo < 3.5)
        muy bajo
      @endif
    @endif. Este índice expresa la relación entre
    los kg de músculo que tiene una persona y sus kg de masa ósea. Un valor óptimo máximo es
    cercano a 5, es decir 5 kg de músculo por cada kg de hueso. Este valor se correlaciona con un
    nivel de salud y de rendimiento deportivo.</p>

    <p>El índice adiposo/muscular se encuentra @if($nutrition->gender == 'f')
      @if($nutrition->indice_adiposo < 0.55)
        excelente
      @endif
      @if($nutrition->indice_adiposo >= 0.55  && $nutrition->indice_adiposo < 0.7)
        bueno
      @endif
      @if($nutrition->indice_adiposo >= 0.7  && $nutrition->indice_adiposo < 0.88)
        aceptable
      @endif
      @if($nutrition->indice_adiposo >= 0.88  && $nutrition->indice_adiposo < 1.06)
        elevado
      @endif
      @if($nutrition->indice_adiposo >= 1.06)
        muy elevado
      @endif
    @else
      @if($nutrition->indice_adiposo < 0.36)
        excelente
      @endif
      @if($nutrition->indice_adiposo >= 0.36  && $nutrition->indice_adiposo < 0.41)
        bueno
      @endif
      @if($nutrition->indice_adiposo >= 0.42  && $nutrition->indice_adiposo < 0.54)
        aceptable
      @endif
      @if($nutrition->indice_adiposo >= 0.54  && $nutrition->indice_adiposo < 0.65)
        elevado
      @endif
      @if($nutrition->indice_adiposo >= 0.65)
        muy elevado
      @endif
    @endif. Este índice expresa cuantos kg de masa
    adiposa tiene que transportar cada kg de masa muscular. Mientras más bajo es este valor más
    eficiente será la actividad para desplazarse.</p>

    <p>La sumatoria de 6 pliegues es de {{($nutrition->tricep + $nutrition->subescapular + $nutrition->supraespinal + $nutrition->abdominal + $nutrition->muslo_medial +  $nutrition->pierna_mm)}} mm. Al disminuir esta sumatoria se indica que ha
    bajado la masa adiposa.
    </p>

    <p>El índice de masa corporal (IMC) es la relación del peso con la estatura, encontrándose
      @if($nutrition->indice_corporal < 18.5)
        bajo
      @elseif(24.9 < $nutrition->indice_corporal)
        alto
      @else
        normal
      @endif. El IMC no refleja la composición corporal, por tanto no es representativo en el
    diagnóstico nutricional.
    </p>

    <p>El somatotipo es @if((round($nutrition->endo, 1) >= round($nutrition->meso, 1)) && (round($nutrition->endo, 1) >= round($nutrition->ecto, 1)))
      endomorfo
    @elseif((round($nutrition->meso, 1) >= round($nutrition->endo, 1)) && (round($nutrition->meso, 1) >= round($nutrition->ecto, 1)))
      mesomorfo
    @else
      ectomorfo
    @endif.
      @if($nutrition->endo >= 7.5)
        Extremadamente alta adiposidad relativa; muy abundante grasa subcutánea y grandes cantidades de grasa abdominen el tronco; concentración proximal de grasa en extremidades.
      @else
        @if($nutrition->endo >= 5.5)
          Alta adiposidad relativa; grasa subcutánea abundante; redondez en tronco y extremidades; mayor acumulación de grasa en el abdomen.
        @else
          @if($nutrition->endo >= 3)
            Moderada adiposidad relativa; la grasa subcutánea cubre los contornos musculares y óseos; apariencia más blanda.
          @else
            Baja adiposidad relativa; poca grasa subcutánea; contornos musculares y óseos visibles.
          @endif
        @endif
      @endif El somatotipo
    provee una descripción general de la forma corporal, no tienen relación en la composición
    corporal, por tanto no indica la cantidad precisa de grasa, músculo y hueso.
    </p>

    <h3>DIAGNÓSTICO NUTRICIONAL:</h3>
    <p>Masa adiposa elevada y masa muscular normal.</p>

    <p>Dentro de los objetivos se buscara obtener una reducción de masa adiposa (-5 kg), y así se
    mejorara el índice adiposo muscular, el índice músculo óseo y la sumatoria de 6 pliegues. La
    masa muscular debe preservarse en este periodo, para luego aumentar de manera
    progresiva (+2 kg).</p>
  </div>

  <div style="font-size: 20px; color: purple; text-align: right;">
    <p style="font-weight: bold;">Melissa Ross Guerra</p>
    <p>Nutricionista Deportiva</p>
  </div>
  <x-flash-message></x-flash-message>
  </div>
</body>
