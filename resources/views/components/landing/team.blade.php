<div class="mt-24">
  <script>
    window.carousel = function () {
      return {
        container: null,
        prev: null,
        next: null,
        init() {
          this.container = this.$refs.container

          this.update();

          this.container.addEventListener('scroll', this.update.bind(this), {passive: true});
        },
        update() {
          const rect = this.container.getBoundingClientRect();

          const visibleElements = Array.from(this.container.children).filter((child) => {
            const childRect = child.getBoundingClientRect()

            return childRect.left >= rect.left && childRect.right <= rect.right;
          });

          if (visibleElements.length > 0) {
            this.prev = this.getPrevElement(visibleElements);
            this.next = this.getNextElement(visibleElements);
          }
        },

        getPrevElement(list) {
          const sibling = list[0].previousElementSibling;

          if (sibling instanceof HTMLElement) {
            return sibling;
          }

          return null;
        },
        getNextElement(list) {
          const sibling = list[list.length - 1].nextElementSibling;

          if (sibling instanceof HTMLElement) {
            return sibling;
          }

          return null;
        },
        scrollTo(element) {
          const current = this.container;

          if (!current || !element) return;

          const nextScrollPosition =
            element.offsetLeft +
            element.getBoundingClientRect().width / 2 -
            current.getBoundingClientRect().width / 2;

          current.scroll({
            left: nextScrollPosition,
            behavior: 'smooth',
          });
        }
      };
    }
  </script>
  <style>
    .scroll-snap-x {
      scroll-snap-type: x mandatory;
    }

    .snap-center {
      scroll-snap-align: center;
    }

    .no-scrollbar::-webkit-scrollbar {
      display: none;
    }

    .no-scrollbar {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }
  </style>

    @php
        $files = File::allFiles('img/equipo/');
        shuffle($files);
    @endphp

<div class="bg-primary-500 py-8 ">
    <h2 class="text-3xl text-center font-bold text-white">¿Quiénes somos?</h2>
    <div class="mt-12 flex mx-auto items-center relative "> 
        <div x-data="carousel()" x-init="init()" class="relative overflow-hidden group">
        <div x-ref="container"
            class="md:-ml-4 md:flex md:overflow-x-scroll scroll-snap-x md:space-x-4 space-y-4 md:space-y-0 no-scrollbar">
            @foreach(App\Models\Team::allTeam() as $team)
                <div
                class="ml-4 flex-auto flex-grow-0 flex-shrink-0 w-96 rounded-lg bg-gray-100 items-center justify-center snap-center overflow-hidden shadow-md">
                    <div>
                      <img class="w-full h-64 object-cover" src="{{ asset('img/equipo/'.$team->photo)}}">
                    </div>
                    <div class="flex">
                        <div class="flex-1 p-4">
                            <h3 class="text-xl font-bold text-gray-900">{{ $team->name }}</h3>
                            <p class="text-gray-700">{{ $team->position }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div @click="scrollTo(prev)" x-show="prev !== null"
            class="hidden md:block absolute top-1/2 left-0 bg-white p-2 rounded-full transition-transform ease-in-out transform -translate-x-full -translate-y-1/2 group-hover:translate-x-0 cursor-pointer">
            <div>&lt;</div>
        </div>
        <div @click="scrollTo(next)" x-show="next !== null"
            class="hidden md:block absolute top-1/2 right-0 bg-white p-2 rounded-full transition-transform ease-in-out transform translate-x-full -translate-y-1/2 group-hover:translate-x-0 cursor-pointer">
            <div>&gt;</div>
        </div>
        </div>
    </div>
    </div>
    </div>
</div>

