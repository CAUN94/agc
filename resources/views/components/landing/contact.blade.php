@php
    $imgs = json_encode(explode('|', $img));
@endphp

<section id="contact" class="bg-primary-500">
    <h2 class="text-center text-light-grey pt-5 lg:text-3xl text-2xl">¿Dónde nos encontramos?</h2>
    <div class="contact">
        <a
        class="text-center"
        target="_blank"
        href="https://www.google.com/maps/dir//San+Pascual+736+Las+Condes+Regi%C3%B3n+Metropolitana/@-33.4178579,-70.5775512,16z/data=!4m5!4m4!1m0!1m2!1m1!1s0x9662cf1e8273f745:0x65dbdf4e0b964b33">
            <i class="fas fa-map-marker-alt"></i>
            San Pascual 736, Las Condes, Santiago
        </a>
        <a
        target="_blank"
        href="https://api.whatsapp.com/send?phone=56933809726&text=Hola!">
            <i class="fab fa-whatsapp"></i>
            +569 33809726
        </a>
    </div>
</section>

<div x-data="{
    activeSlide: 1,
    imgs: {{$imgs}},
    timer2: 10000,
    addOne: function() {
            if(this.activeSlide === 1){
                this.activeSlide = this.imgs.length
            } else {
                this.activeSlide--
            }
        }
    }",
    x-init="$interval(addOne, timer2)" x-cloack>
    <div class="relative">
        <section class="absolute bottom-0 right-0">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3330.2065919308297!2d-70.57973988482027!3d-33.41785788078324!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9662cf1e8273f745%3A0x65dbdf4e0b964b33!2sSan%20Pascual%20736%2C%20Las%20Condes%2C%20Regi%C3%B3n%20Metropolitana!5e0!3m2!1ses-419!2scl!4v1633367044424!5m2!1ses-419!2scl" class="w-32 lg:w-64 h-20 lg:h-36 " style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </section>
        <template x-for="(img,index) in imgs">
            <div class="img-slider"
            x-show="activeSlide === index+1">
                <img style="height: 410px;" :src="'img/caroussel/' + img" x-cloack>
            </div>
        </template>
        <button type="button" class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none" data-carousel-prev  x-on:click="activeSlide = activeSlide === 1 ? slides.length : activeSlide - 1">
            <span class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                <span class="hidden">Previous</span>
            </span>
        </button>
        <button type="button" class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none" data-carousel-next @click="addOne">
            <span class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <span class="hidden">Next</span>
            </span>
        </button>
    </div>
</div>
