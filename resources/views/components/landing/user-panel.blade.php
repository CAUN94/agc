<div class="container mx-auto mt-4">
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex-col sm:flex-row flex gap-4">
        <div class="w-full order-1 sm:order-1 sm:w-1/6 flex flex-col gap-y-4">
        {{-- <div class="w-full order-2 sm:order-1 sm:w-1/5 bg-gray-50 shadow overflow-hidden sm:rounded-lg"> --}}
          <div class="bg-gray-50 shadow overflow-hidden sm:rounded-lg ">
            <div class="flex px-4 py-2 sm:py-5 sm:px-6 justify-between items-center">
              <div class="flex flex-col">
                <h3 class="text-base sm:text-xl font-medium text-primary-500 py-4">
                  Menu
                </h3>
            {{--     <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    <span class="text-gray-500">Proximas horas</span>
                </p> --}}
              </div>
            </div>
            <div class="border-t border-gray-200">
              <x-landing.user-panel-menu></x-landing.user-panel-menu>

            </div>
          </div>
        </div>

        {{$slot}}

      </div>
    </div>



</div>
