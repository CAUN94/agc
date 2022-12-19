Hola
@if(isset($body->links->next))
@php $next = explode('cursor=',$body->links->next)[1]; @endphp
<a href="/apimedilink/convenios/{{$next}}">Next</a>
@endif
@if(isset($body->links->prev))
@php $prev = explode('cursor=',$body->links->prev)[1]; @endphp
<a href="/apimedilink/convenios/{{$prev}}">Prev</a>
@endif
@foreach($body->data as $value)
	<br>
	{{$value->nombre}}
@endforeach
