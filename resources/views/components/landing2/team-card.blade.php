@props([
    'person'
])
<div class="w-full h-auto relative">
	<img class="rounded-3xl" src="{{$person['img']}}">
	<div class="team-card">
  		<span>{{$person['name']}}</span>
      <ul>
        {!! $person['info'] !!}
      </ul>
  	</div>
</div>
