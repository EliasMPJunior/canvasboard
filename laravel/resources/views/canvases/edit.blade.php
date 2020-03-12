@extends('layouts.layout')

@section('content')
<!doctype html>
	<div class="container">

		<div class="py-5 text-center">
			<img class="d-block mx-auto mb-4" src="{{ asset('assets/img/grid.svg') }}" alt="" width="72" height="72">
			<h2>Let's do it!</h2>
			<!--
			<p class="lead">Below is an example form built entirely with Bootstrap's form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
			-->
		</div>

		<div class="row">
			<div class="col-md-12 order-md-1">
				<form action="{{ route($front_control->workspace_bar['canvases.update']->route, $front_control->object_unit->id) }}" method="POST" class="needs-validation" novalidate>
					@csrf
					@method ('PATCH')

					<div class="mb-3">
						<label for="name">Your canvas is under the name</label>
						<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="" value="{{ $front_control->object_unit->name }}" required>
						<div class="invalid-feedback">
							Please enter the name of the canva.
						</div>
					</div>

					<div class="mb-3">
						<label for="type">And it's type is</label>
						<select class="custom-select d-block w-100 @error('type') is-invalid @enderror" name="type" id="type" required disabled>
							<option value="">Choose...</option>
							@foreach ($front_control->type_of_board_list as $type_of_board)
							<option value="{{ $type_of_board->uuid }}" @if($front_control->object_unit->type == $type_of_board->uuid) selected @endif>
								{{ $type_of_board->name }}
							</option>
							@endforeach
						</select>
						<div class="invalid-feedback">
							Please select a valid type of canvas.
						</div>
					</div>

					<div class="mb-3">
						<label for="description">Your canvas is described as</label>
						<textarea class="form-control" name="description" id="description">{{ $front_control->object_unit->description }}</textarea>
					</div>

					<hr class="mb-4">
					<button class="btn btn-primary btn-lg btn-block" type="submit">{{ $front_control->workspace_bar['canvases.update']->name }}</button>
				</form>
			</div>
		</div>
	</div>
@endsection