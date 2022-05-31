<div class="bg-you-grey text-center py-12">
    <p class="font-futura text-white text-2xl">Siguenos en nuestras <span class="text-primary-500">RRSS</span></p>
</div>
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
    @php $profile = \Dymantic\InstagramFeed\Profile::where('username','yjb')->first(); @endphp
    @php $feed = $profile->refreshFeed(8); @endphp
     <div class="small-gallery">
        @foreach($feed as $post)
            @if($post['type'] == 'image')
                <a href="{{ $post['permalink'] }}" target="_blank">
                  <img src="{{ $post['url'] }}" alt="instagram picture">
                </a>
            @endif
        @endforeach
    </div>
</section>
