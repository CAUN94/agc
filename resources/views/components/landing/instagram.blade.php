<section class="bg-light-grey h-auto py-4">
    <div class="container mx-auto pb-5">
        <div class="insta">
            <img class="rrss-icon" src="{{ asset('/img/icon.png')}}" alt="logo">
            <span>
                <a class="lowercase text-2xl" target="_blank" href="https://www.instagram.com/you.justbetter/?hl=es-la">
                    <i class="fab fa-instagram"></i>
                    you.justbetter</a>
            </span>
        </div>
    </div>
    @php $feed = \Dymantic\InstagramFeed\InstagramFeed::for('yjb',1); @endphp
    {{$profile}}
    <div class="small-gallery">
        {{-- @foreach($profile as $post)
            <a href="https://www.instagram.com/p/COtZ_SqIz9T/?utm_source=ig_web_copy_link" target="_blank">
              <img src="{{ $post->url }}" alt="">
            </a>
        {{-- @endforeach --}}
    </div>
</section>
