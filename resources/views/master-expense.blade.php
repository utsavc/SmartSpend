@extends('layout.app') 
@section('content') 

<div class="row container-fluid">

	@include('layout.sidelayout')


	<div class="col-lg-10 p-3">



		<div class="container">		
			<h4>Master Expense</h4> <br>
			@if(session('deleted'))
			<div class="alert alert-danger">
				{{ session('deleted') }}
			</div>
			@endif

			<ul class="nav nav-tabs" id="myTabs" role="tablist">
				<li class="nav-item" role="presentation">
					<a class="nav-link active text-primary" id="pending-tab" data-bs-toggle="tab" href="#pending" role="tab" aria-controls="home" aria-selected="true">Submitted</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link text-success" id="approved-tab" data-bs-toggle="tab" href="#approved" role="tab" aria-controls="profile" aria-selected="false">Approved</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link text-danger" id="rejected-tab" data-bs-toggle="tab" href="#rejected" role="tab" aria-controls="profile" aria-selected="false">Rejected</a>
				</li>

				<li class="nav-item" role="presentation">
					<a class="nav-link" id="drafted-tab" data-bs-toggle="tab" href="#drafted" role="tab" aria-controls="profile" aria-selected="false">Drafted</a>
				</li>

			</ul>
			<div class="tab-content" id="myTabsContent">
				<div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th>Date</th>
								<th scope="col">Amount</th>
								<th scope="col">Description</th>
								<th scope="col">Category</th>
								<th scope="col">Details</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
							@php $serialNumber = 1; @endphp
							@foreach ($submitted as $expense)
							<tr>
								<td>{{ $serialNumber++ }}</td>		
								<td>{{ $expense->created_at->format('Y-m-d') }}</td>
								<td>{{ $expense->amount }}</td>
								<td>{{ $expense->description }}</td>
								<td>{{ $expense->category }}</td>
								<td><a href="detail/{{$expense->id}}" class="btn btn-sm btn-info">View</a></td>	
								<td><a href="delete-expense/{{$expense->id}}" class="btn btn-sm btn-danger">Delete</a></td>
							</tr>
							@endforeach

						</tbody>
					</table>
				</div>


				<div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved-tab">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th>Date</th>
								<th scope="col">Amount</th>
								<th scope="col">Description</th>
								<th scope="col">Category</th>
								<th scope="col">Details</th>
								<th>Remarks</th>
							</tr>
						</thead>
						<tbody>
							@php $serialNumber = 1; @endphp
							@foreach ($approveds as $expense)
							<tr>
								<td>{{ $serialNumber++ }}</td>		
								<td>{{ $expense->created_at->format('Y-m-d') }}</td>
								<td>{{ $expense->amount }}</td>
								<td>{{ $expense->description }}</td>
								<td>{{ $expense->category }}</td>
								<td><a href="detail/{{$expense->id}}" class="btn btn-sm btn-primary">View</a></td>
								<td>
									<a href="delete-expense/{{$expense->id}}" class="btn btn-sm btn-danger">Delete</a>
									<a href="reject-expense/{{$expense->id}}" class="btn btn-sm btn-danger">Reject</a>
								</td>
							</tr>
							@endforeach

						</tbody>
					</table>
				</div>


				<div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="rejected-tab">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th>Date</th>
								<th scope="col">Amount</th>
								<th scope="col">Description</th>
								<th scope="col">Category</th>
								<th scope="col">Details</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
							@php $serialNumber = 1; @endphp
							@foreach ($rejected as $expense)
							<tr>
								<td>{{ $serialNumber++ }}</td>								
								<td>{{ $expense->created_at->format('Y-m-d') }}</td>
								<td>{{ $expense->amount }}</td>
								<td>{{ $expense->description }}</td>
								<td>{{ $expense->category }}</td>
								<td><a href="detail/{{$expense->id}}" class="btn btn-sm btn-primary">View</a></td>
								<td><a href="{{ route('delete-expense', ['id' => $expense->id]) }}" class="btn btn-sm btn-danger">Delete</a></td>
							</tr>
							@endforeach

						</tbody>
					</table>
				</div>

				<div class="tab-pane fade" id="drafted" role="tabpanel" aria-labelledby="drafted-tab">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th>Date</th>
								<th scope="col">Amount</th>
								<th scope="col">Description</th>
								<th scope="col">Category</th>
								<th scope="col">Details</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
							@php $serialNumber = 1; @endphp
							@foreach ($drafted as $expense)
							<tr>
								<td>{{ $serialNumber++ }}</td>								
								<td>{{ $expense->created_at->format('Y-m-d') }}</td>
								<td>{{ $expense->amount }}</td>
								<td>{{ $expense->description }}</td>
								<td>{{ $expense->category }}</td>
								<td><a href="detail/{{$expense->id}}" class="btn btn-sm btn-primary">View</a></td>
								<td><a href="delete-expense/{{$expense->id}}" class="btn btn-sm btn-danger">Delete</a></td>
							</tr>
							@endforeach

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>



@endsection