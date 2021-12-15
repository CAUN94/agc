<div x-data="{ {{$trigger}}: false }">
  <div @click.away="{{$trigger}} = false" @click="{{$trigger}} = !{{$trigger}}" class="dropdown relative mt-3">
    <button>
      <span>{{$name}}</span>
      <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': {{$trigger}}, 'rotate-0': !{{$trigger}}}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
    </button>
  </div>
  <div x-show="{{$trigger}}" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="shadow rounded w-full mt-2 z-20" x-cloak>
      <div class="py-2 px-1 bg-white rounded-md shadow">
        {{ $slot }}
      </div>
  </div>
</div>
