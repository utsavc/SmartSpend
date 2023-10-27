@extends('layout.app') 
@section('content') 
<div class="container">
	<div class="row justify-content-center mt-5 mb-5">
		<div class="col-md-6 border p-5" >
			<h3 class="text-center">Login</h3>

			<form method="post" action="{{ route('login')}}">
				@csrf
				<div class="mb-3">
					<label  class="form-label">Email address</label>
					<input type="email" name="email" class="form-control" required>
				</div>

				<div class="mb-3">
					<label class="form-label">Password</label>
					<input type="password" name="password" class="form-control" required>
				</div>

				<div class="">
					<button type="submit" class="btn btn-sm btn-danger">Submit</button>        
				</div>

				@if (session('error'))
				<br>
				<div class="alert alert-danger">
					{{ session('error') }}
				</div>
				@endif

				@if (session('info'))
				<br>
				<div class="alert alert-info">
					{{ session('info') }}
				</div>
				@endif

			</form>

		</div>


	</div>
</div>

<div style="margin-top:220px"></div>
@endsection