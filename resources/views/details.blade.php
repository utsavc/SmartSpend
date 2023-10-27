@extends('layout.app') 
@section('content') 



<div class="row container-fluid">

	
	@include('layout.sidelayout')

	<div class="col-lg-10">




		<div class="container mt-5">

			<h3 class="mt-2 mb-2">Details</h3>
			<div class="row">
				<div class="col-sm-8">
					Submitted By: {{$expense->submittedByUser->name}} <br>
					Department:{{$expense->submittedByUser->department}} <br>	
					Position:{{$expense->submittedByUser->position}} <br>
					Amount:{{$expense->amount}} <br>
					Description:{{$expense->description}} <br>
					Category:{{$expense->category}} <br>
					Status:
					@if ($expense->status === 'pending' || $expense->status === 'accepted')
					<span class="text-primary">Pending</span>
					@elseif($expense->status==='approved')
					<span class="text-success">Approved</span>
					@elseif($expense->status==='drafted')
					<span class="text-info">Drafted</span>
					@else
					<span class="text-danger">{{$expense->status}}</span>
					@endif


					@if (Auth::user()->position==="hod")
					<div class="row mt-2">
						@if($expense->status =='pending'  || $expense->status=='accepted')

						<div class="col-md-auto">
							<form class="form-inline" method="post" action="{{ route('expense.approve')}}">
								@csrf
								<input type="hidden" name="id" value="{{$expense->id}}">
								<button class="btn btn-sm btn-success">Approve</button>
							</form>
						</div>
						@endif

						@if($expense->status!='rejected_hod' && $expense->status!='rejected_manager' && $expense->status!='approved')

						<div class="col-md-auto">
							<form class="form-inline" method="post" action="{{ route('expense.reject')}}">
								@csrf
								<input type="hidden" name="id" value="{{$expense->id}}">
								<button class="btn btn-sm btn-danger">Reject</button>
							</form>
						</div>
						@endif
					</div>
					@endif



					@if (Auth::user()->position==="manager")
					<div class="row mt-2">
						@if($expense->status =='pending')
						<div class="col-md-auto">
							<form class="form-inline" method="post" action="{{ route('expense.approve')}}">
								@csrf
								<input type="hidden" name="id" value="{{$expense->id}}">
								<button class="btn btn-sm btn-success">Approve</button>
							</form>
						</div>

						<div class="col-md-auto">
							<form class="form-inline" method="post" action="{{ route('expense.reject')}}">
								@csrf
								<input type="hidden" name="id" value="{{$expense->id}}">
								<button class="btn btn-sm btn-danger">Reject</button>
							</form>
						</div>

						@endif
					</div>
					@endif





					@if (Auth::user()->position==="system_manager")
					@if($expense->status !='drafted')

					<div class="row mt-2">
						<div class="col-md-auto">
							<form class="form-inline" method="post" action="{{ route('expense.approve')}}">
								@csrf
								<input type="hidden" name="id" value="{{$expense->id}}">
								<button class="btn btn-sm btn-success">Approve</button>
							</form>
						</div>

						<div class="col-md-auto">
							<form class="form-inline" method="post" action="{{ route('expense.reject')}}">
								@csrf
								<input type="hidden" name="id" value="{{$expense->id}}">
								<button class="btn btn-sm btn-danger">Reject</button>
							</form>
						</div>
					</div>	
					@endif	

					@endif



					
				</div>
				<div class="col-sm-4">
					<img class="img-thumbnail" src="{{ asset($expense->supporting_document) }}">
				</div>
			</div>

		</div>
	</div>
</div>



@endsection