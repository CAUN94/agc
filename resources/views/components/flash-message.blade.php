@if(session()->has('primary'))
    <div class="fixed bottom-4 min:w-56 z-50 w-auto right-4 bg-primary-100 border-l-4 border-primary-500 text-primary-700 p-4" role="alert"
        x-data="{ show: false }"
        x-init="() => {
            setTimeout(() => show = true, 500);
            setTimeout(() => show = false, 3000);
          }"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90"
        x-cloak>
      <p class="font-bold">Team You</p>
      <p class="text-black-500">{{ session()->get('primary') }}</p>
    </div>
    {{ session()->forget('primary') }}
@endif
