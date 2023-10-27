@extends('layout.app') <!-- Extending the 'app' layout -->

@section('content') <!-- Starting the 'content' section -->

<div class="row container-fluid">

	@include('layout.sidelayout') <!-- Including a sidebar layout, if available -->

	<div class="col-lg-10">

		<div class="container">
			<div class="row mt-2 mb-3">

				@if(session('success'))
				<div class="alert alert-success">
					{{ session('success') }}
				</div>
				@endif

				@if(session('deleted'))
				<div class="alert alert-danger">
					{{ session('deleted') }}
				</div>
				@endif

				<div class="col-md-6 border p-5">
					<h3 class="text-center">Add Department</h3>

					<form name="department" action="{{ route('department.add')}}" method="post">
						@csrf <!-- CSRF token for security -->
						<div class="mb-3">
							<label class="form-label">Department</label>
							<input type="text" name="department" class="form-control @error('department') is-invalid @enderror" required>
							@error('department')
							<div class="invalid-feedback">
								{{ $message }} <!-- Display the error message for 'department' -->
							</div>
							@enderror
						</div>

						<div class="">
							<button type="submit" class="btn btn-sm btn-danger">Add</button>
						</div>
					</form>
				</div>

				<div class="col-md-12 mt-5">
					<h3>Department List</h3>
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Department</th>
								<th scope="col">Operation</th>
							</tr>
						</thead>
						<tbody>
							@php $serialNumber = 1; @endphp
							@foreach($department as $dep)
							<tr>
								<td>{{ $serialNumber++ }}</td>
								<td>{{$dep->department}}</td>
								<td> <a href="department/remove/{{$dep->id}}">Remove</a> </td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>

			</div>
		</div>
	</div>
</div>
@endsection <!-- Ending the 'content' section -->
