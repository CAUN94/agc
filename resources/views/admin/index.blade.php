<x-admin.layout>
	<div class="bg-white p-4">
		<h1 class="admin-title-nav">
	        Hola {{Auth::user()->fullname()}}
	    </h1>
	</div>
	@if(Auth::user()->isAdmin())
		<div>
			<livewire:admin-index-panel/>
		</div>
	@endif

</x-admin.layout>
