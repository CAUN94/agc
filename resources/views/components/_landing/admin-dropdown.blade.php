@auth()
<div class="relative" x-data="{ dropdownAdmin: false}" x-cloack>
    <button class="flex items-center focus:outline-none mr-3"
        @click="dropdownAdmin = !dropdownAdmin"
        @keydown.escape="dropdownAdmin = false"
    >
        <img class="w-8 h-8 rounded-full mr-4" src="{{Auth::user()->profilepic()}}" alt="Avatar of User"> <span class="hidden md:inline-block">{{Auth::user()->fullname()}}</span>
        <svg class="pl-2 h-2" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129">
            <g>
                <path d="m121.3,34.6c-1.6-1.6-4.2-1.6-5.8,0l-51,51.1-51.1-51.1c-1.6-1.6-4.2-1.6-5.8,0-1.6,1.6-1.6,4.2 0,5.8l53.9,53.9c0.8,0.8 1.8,1.2 2.9,1.2 1,0 2.1-0.4 2.9-1.2l53.9-53.9c1.7-1.6 1.7-4.2 0.1-5.8z"></path>
            </g>
        </svg>
    </button>
        <ul class="drop-nav" x-show="dropdownAdmin"
        @click.away="dropdownAdmin = false" x-cloak>
            <li><a href="#" class="drop-link">
            <span class="drop-span">My account</span>
            </a></li>
            <li><a href="#" class="drop-link">
            <span class="drop-span">Notifications</span>
            </a></li>
            <li>
                <hr class="border-t mx-2 border-gray-400">
            </li>
            <li><a href="#" class="drop-link">
            <span class="drop-span">Logout</span>
            </a></li>
        </ul>

</div>
@endauth
