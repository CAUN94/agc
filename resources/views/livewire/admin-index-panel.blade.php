<div>
    <div class="m-2 text-lg flex items-center justify-between">
        Periodo<br>
        {{Carbon\Carbon::parse($this->startOfMonth)->format('d F Y')}} a {{Carbon\Carbon::parse($this->endOfMonth)->format('d F Y')}}
        <div class="border rounded-lg px-1" style="padding-top: 2px;">
            <button
                type="button"
                class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 items-center"
                wire:click="subMonth"
                >
                <svg class="h-6 w-6 text-gray-500 inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <div class="border-r inline-flex h-6"></div>
            <button
                type="button"
                class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex items-center cursor-pointer hover:bg-gray-200 p-1"
                wire:click="incrementMonth"
                >
                <svg class="h-6 w-6 text-gray-500 inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
    </div>
    <ul class="grid grid-cols-4 gap-2">
        <li>
            <p class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                <span class="flex-1 ml-3 whitespace-nowrap">Usuarios AGC</span>
                <span class="inline-flex items-center justify-center px-2 py-1 ml-3 text-sm font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{$usersApp}}</span>
            </p>
        </li>
        <li>
            <p class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                <span class="flex-1 ml-3 whitespace-nowrap">Alumnos AGC</span>
                <span class="inline-flex items-center justify-center px-2 py-1 ml-3 text-sm font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{$studentsApp}}</span>
            </p>
        </li>
        <li>
            <p class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                <span class="flex-1 ml-3 whitespace-nowrap">Usuarios Ml</span>
                <a href="/scraping-userml" class="whitespace-nowrap text-sm text-blue-500">Recargar</a>
                <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{$usersMl}}</span>
            </p>
        </li>
        <li>
            <p class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                <span class="flex-1 ml-3 whitespace-nowrap">Actions Ml</span>
                <a href="/scraping-actionml" class="whitespace-nowrap text-sm text-blue-500">Recargar</a>
                <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{$actionsMl}}</span>
            </p>
        </li>
        <li>
            <p class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                <span class="flex-1 ml-3 whitespace-nowrap">AppointmenstMl</span>
                <a href="/scraping-appointmentml" class="whitespace-nowrap text-sm text-blue-500">Recargar</a>
                <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{$appointmenstMl}}</span>
            </p>
        </li>
        <li>
            <p class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                <span class="flex-1 ml-3 whitespace-nowrap">Payments Ml</span>
                <a href="/scraping-paymentsml" class="whitespace-nowrap text-sm text-blue-500">Recargar</a>
                <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{$paymentsMl}}</span>
            </p>
        </li>
        <li>
            <p class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                <span class="flex-1 ml-3 whitespace-nowrap">Treatments Ml</span>
                <a href="/scraping-treatmentsml" class="whitespace-nowrap text-sm text-blue-500">Recargar</a>
                <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{$treatmentsMl}}</span>
            </p>
        </li>
        <li>
            <p class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                <span class="flex-1 ml-3 whitespace-nowrap">Planes</span>
                <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{$plans}}</span>
            </p>
        </li>
    </ul>
</div>
