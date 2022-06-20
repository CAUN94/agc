{{-- <header class="mb-20">
    <div class="header-div">
        <img src={{asset("img/".$img)}}>
        <div>
            {{$text}}
        </div>
    </div>
</header> --}}

@php
    $imgs = json_encode(explode('|', $img));
    $texts = json_encode(explode('|', $text));
    $urls = json_encode(explode('|', $url));
@endphp
<div x-data="{
    activeSlide: 1,
    imgs: {{$imgs}},
    texts: {{$texts}},
    urls: {{$urls}},
    timer: 5000,
    addOne: function() {
            if(this.activeSlide === this.imgs.length){
                this.activeSlide = 1
            } else {
                this.activeSlide++
            }
        }
    }",
    x-init="$interval(addOne, timer)" x-cloack>
    <header class="mb-20">
        <template x-for="(img,index) in imgs">
            <div class="header-div"
            x-show="activeSlide === index+1">
                <img :src="'img/' + img">
                <div class="flex flex-col justify-between">
                    <div x-text="texts[index]"></div>
                    <a
                    x-show="urls[index] != 0"
                    class="mx-auto button-2" :href="urls[index]">Ver Más</a>
                </div>
            </div>
        </template>
    </header>

   {{-- <div class="flex w-1/4 mx-auto justify-around">
        <div class="flex items-center">
            <button
              @keyup.left ="activeSlide = activeSlide === 1 ? imgs.length : activeSlide - 1"
              class="bg-primary-100 text-primary-500 hover:text-orange-500 font-bold hover:shadow-lg rounded-full w-12 h-12 -ml-6"
              x-on:click="activeSlide = activeSlide === 1 ? imgs.length : activeSlide - 1">
              &#8592;
             </button>
        </div>
        <div class="flex items-center">
            <button
             @keyup.right = "activeSlide = activeSlide === imgs.length ? 1 : activeSlide + 1"
              class="bg-primary-100 text-primary-500 hover:text-orange-500 font-bold hover:shadow rounded-full w-12 h-12 -mr-6"
              x-on:click="activeSlide = activeSlide === imgs.length ? 1 : activeSlide + 1">
              &#8594;
            </button>
        </div>
        <div class="absolute w-full flex items-center justify-center px-4">
          <template x-for="(img,index) in imgs" >
            <button
              x-on:click="activeSlide = index"
            ></button>
          </template>
        </div>
    </div> --}}
</div>
