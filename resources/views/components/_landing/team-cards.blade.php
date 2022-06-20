@props([
    'team'
])

<section class="bg-light-grey py-4">
	<div class="team-cards">
		@foreach($team as $person)
		 	<x-landing.team-card :person="$person">
		 	</x-landing.team-card>
		 @endforeach
	</div>
</section>
