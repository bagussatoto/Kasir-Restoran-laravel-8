@if(Session::has('toasts'))
	@foreach(Session::get('toasts') as $toast)
		<div class="alert alert-{{ $toast['level'] }}">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

			@if(!is_null($toast['title']))
				<strong>{{ $toast['title'] }}</strong>
			@endif

			{{ $toast['message'] }}
		</div>
	@endforeach
@endif