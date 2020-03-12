@extends('layouts.layout')

@section('content')
	@if(count($front_control->object_list) < 1)
	<div class="jumbotron">
		<div class="container">
			<h1 class="display-3">Start your first canvas now!</h1>
			<p>How about having a shared canvas instantly available and accessible anywhere? You can do it right now from a great set of models.</p>
			<p><a class="btn btn-primary btn-lg" href="{{ route($front_control->workspace_bar['canvases.create']->route) }}" role="button">{{ $front_control->workspace_bar['canvases.create']->name }} &raquo;</a></p>
		</div>
	</div>
	@else

	<!-- CONTAINER -->
	<div class="container-fluid">
		<!-- Example row of columns -->
		<div class="row mx-2">
			<div class="col-md-4 d-flex flex-column text-center alert alert-secondary" role="alert">
				<h2 class="text-muted">Oooops</h2>
				<p>Your account type does not support more then 1 canvas.</p>
				<p class="mt-auto">
					<button class="btn btn-outline-dark" disabled href="{{ route($front_control->workspace_bar['canvases.create']->route) }}" role="button">
						{{ $front_control->workspace_bar['canvases.create']->name }} &raquo;
					</button>
				</p>
			</div>
			@foreach($front_control->object_list as $canvas)
			<div class="col-md-4 text-center">
				<h2>{{ $canvas->name }}</h2>
				<p>{{ $canvas->description }}</p>
				<p class="">
					<a class="btn btn-secondary" href="{{ route($front_control->workspace_bar['canvases.show']->route, $canvas->id) }}" role="button">{{ $front_control->workspace_bar['canvases.show']->name }} &raquo;</a>
				</p>
			</div>
			@endforeach
		</div>

		<hr>

	</div>
	<!-- END CONTAINER -->
	@endif

  <!-- FOOTER -->
  @section('footer')
    @include('layouts.footer')
  @show
  <!-- END FOOTER -->
@endsection