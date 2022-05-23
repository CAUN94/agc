

<div x-data="{
    activeSlide: 1,
    imgs: ['alonso.jpg','daniella.jpg','cesar.jpg','mariajesus.jpg'],
    texts: ['alonso','daniella','cesar','mariajesus'],
    timer: 10000,
    addOne: function() {
            if(this.activeSlide === this.imgs.length){
                this.activeSlide = 1
            } else {
                this.activeSlide++
            }
        }
    }",
    x-init="$interval(addOne, timer)" x-cloack>
    <div class="relative">
        <template x-for="(img,index) in imgs">
            <div class="flex flex-col mx-auto py-4"
            x-show="activeSlide === index+1">
                <img class="object-cover mx-auto h-64" :src="'img/equipo/' + img">
                <div class="flex mx-auto">
                    <button type="button" class="flex relative z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none" data-carousel-prev  x-on:click="activeSlide = activeSlide === 1 ? slides.length : activeSlide - 1">
                        <span class="inline-flex text-you-grey justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>Hola</svg>
                            <span class="hidden">Previous</span>
                        </span>
                    </button>
                    <button type="button" class="flex relative z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none" data-carousel-next @click="addOne">
                        <span class="inline-flex text-you-grey justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            <span class="hidden">Next</span>
                        </span>
                    </button>
                </div>
                <div class="text-white text-center text-3xl" x-text="texts[index]"></div>
                <div class="text-white text-center text-lg">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</div>

            </div>

        </template>


    </div>
</div>
