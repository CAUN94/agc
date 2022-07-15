<x-landing.layout>
  <x-landing.user-panel>
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
      <div class="w-full h-full grid grid-cols-2 gap-4">
        <div class="bg-gray-50 shadow overflow-hidden sm:rounded-lg ">
          <div class="bg-white text-base px-4 py-5 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-6 overflow-y-scroll">
            <a class="flex justify-between items-center" href="/strava/show">Vincula tu Strava <img class="h-4" src="{{ asset('/img/strava.png') }}"></a>
          </div>
        </div>
      </div>
    </div>
    </div>

  </x-landing.user-panel>
</x-landing.layout>
