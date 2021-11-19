<nav class="bg-light-grey ">
  <div class="max-w-7xl w-full px-2 sm:px-6 lg:px-8">
    <div class="relative flex items-center  h-16">
      <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
        <div class="block sm:ml-6">
          <div class="flex space-x-4">
            {{-- <a href="#" class="text-you-grey px-3 py-2 rounded-md text-sm font-medium">Inicio</a> --}}
          </div>
        </div>
      </div>
      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
        {{-- <button type="button" class="bg-light-grey p-1 rounded-full text-you-grey hover:text-primary-500">
          <span class="sr-only">View notifications</span>
          <!-- Heroicon name: outline/bell -->
          <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
          </svg>
        </button> --}}

        <!-- Profile dropdown -->
        <div class="ml-3 relative" x-data="{ usernav: false }">
          <div>
            <button @click.away="usernav = false" @click="usernav = !usernav" type="button" class="flex text-sm rounded-full" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
              <img class="h-10 w-10 rounded-full" src="{{Auth::user()->profilePic()}}" alt="">
            </button>
          </div>
            <ul x-show="usernav" class="drop-nav" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" x-cloak>
              <li>
                <a href="#" class="drop-link block text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">
                  <span class="drop-span">Your Profile</span>
                </a>
              </li>
              <li>
                <a href="#" class="drop-link block text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">
                  <span class="drop-span">Settings</span>
                </a>
              </li>
              <li>
                <a href="#" class="drop-link block text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">
                  <span class="drop-span">Sign out</span>
                </a>
              </li>
            </ul>
        </div>
      </div>
    </div>
  </div>
</nav>
