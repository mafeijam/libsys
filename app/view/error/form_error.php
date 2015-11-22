@if (Session::has('error'))
	<div class="red">
		@foreach (flash('error') as $error)
		<p><i class="fa fa-exclamation-triangle"></i>{! $error !}</p>
		@endforeach
	</div>
@endif