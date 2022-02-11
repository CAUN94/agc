{{-- <div class="fixed rounded-full items-center justify-center bottom-4 right-4 h-16 w-16 bg-green-500 text-primary-700 p-4" role="alert">
  Hola
</div> --}}
@if(Auth::user()->isStudent())
  <div class="fixed bottom-24 text-4xl right-4 rounded-full h-16 w-16 flex items-center justify-center bg-primary-100 text-white">
      <a href="/students"><i class="fas fa-dumbbell"></i></a>
  </div>
@endif
