		<div class="container">
			<h4>Expense Details</h4>
			<ul class="nav nav-tabs" id="myTabs" role="tablist">
				<li class="nav-item" role="presentation">
					<a class="nav-link active text-warning" id="home-tab" data-bs-toggle="tab" href="#pending" role="tab" aria-controls="home" aria-selected="true">Pending Expenses</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link text-success" id="profile-tab" data-bs-toggle="tab" href="#approved" role="tab" aria-controls="profile" aria-selected="false">Approved Expenses</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link text-danger" id="profile-tab" data-bs-toggle="tab" href="#rejected" role="tab" aria-controls="profile" aria-selected="false">Rejected</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabsContent">
				<div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="home-tab">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th>Date</th>
								<th scope="col">Amount</th>
								<th scope="col">Description</th>
								<th scope="col">Category</th>
								<th scope="col">Details</th>
							</tr>
						</thead>
						<tbody>
							@php $serialNumber = 1; @endphp
							@foreach ($pendings as $expense)
							<tr>
								<td>{{ $serialNumber++ }}</td>
								<td>{{ $expense->created_at->format('Y-m-d') }}</td>
								<td>{{ $expense->amount }}</td>
								<td>{{ $expense->description }}</td>
								<td>{{ $expense->category }}</td>
								<td><a href="detail/{{$expense->id}}" class="btn btn-sm btn-info">View</a></td>	
							</tr>
							@endforeach

						</tbody>
					</table>
				</div>





				<div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="profile-tab">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th>Date</th>
								<th scope="col">Amount</th>
								<th scope="col">Description</th>
								<th scope="col">Category</th>
								<th scope="col">Details</th>
							</tr>
						</thead>
						<tbody>
							@php $serialNumber = 1; @endphp
							@foreach ($details as $expense)
							<tr>
								<td>{{ $serialNumber++ }}</td>
								<td>{{ $expense->created_at->format('Y-m-d') }}</td>
								<td>{{ $expense->amount }}</td>
								<td>{{ $expense->description }}</td>
								<td>{{ $expense->category }}</td>
								<td><a href="detail/{{$expense->id}}" class="btn btn-sm btn-info">View</a></td>
							</tr>
							@endforeach

						</tbody>
					</table>
				</div>




				<div class="tab-pane fade show" id="rejected" role="tabpanel" aria-labelledby="home-tab">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th>Date</th>
								<th scope="col">Amount</th>
								<th scope="col">Description</th>
								<th scope="col">Category</th>
								<th scope="col">Details</th>
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
								<td><a href="detail/{{$expense->id}}" class="btn btn-sm btn-info">View</a></td>	
							</tr>
							@endforeach

						</tbody>
					</table>
				</div>


			</div>
		</div>