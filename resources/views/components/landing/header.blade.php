<header class="mb-20">
    <div class="header-div">
        {{$img}}
        <div>
            {{$slot}}
        </div>
    </div>
</header>

{{-- @php
    $imgs = json_encode(explode('|', $img));
    $texts = json_encode(explode('|', $text));
@endphp
<div x-data="{ activeSlide: 0,
imgs: {{$imgs}}">
    <header class="mb-20">
        <template x-for="img in imgs">
            <div class="header-div">
                <div x-text="img">
                    Hola
                </div>
            </div>
        </template>
    </header>
    <div class="flex w-1/4 mx-auto justify-around">
        <div class="flex items-center">
            <button
              class="bg-primary-100 text-primary-500 hover:text-orange-500 font-bold hover:shadow-lg rounded-full w-12 h-12 -ml-6"
              x-on:click="activeSlide = activeSlide === 1 ? slides.length : activeSlide - 1">
              &#8592;
             </button>
        </div>
        <div class="flex items-center">
            <button
              class="bg-primary-100 text-primary-500 hover:text-orange-500 font-bold hover:shadow rounded-full w-12 h-12 -mr-6"
              x-on:click="activeSlide = activeSlide === slides.length ? 1 : activeSlide + 1">
              &#8594;
            </button>
        </div>
        <div class="absolute w-full flex items-center justify-center px-4">
          <template x-for="slide in slides" :key="slide">
            <button
              x-on:click="activeSlide = slide"
            ></button>
          </template>
        </div>
    </div>
</div>
 --}}
