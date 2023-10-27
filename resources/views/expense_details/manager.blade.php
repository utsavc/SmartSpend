
		<div class="container mt-3">
			<h4>Expense Details</h4>
			<ul class="nav nav-tabs" id="myTabs" role="tablist">
				<li class="nav-item" role="presentation">
					<a class="nav-link text-warning active" id="home-tab" data-bs-toggle="tab" href="#pending" role="tab" aria-controls="home" aria-selected="true">Staff Pending</a>
				</li>
				
				<li class="nav-item" role="presentation">
					<a class="nav-link text-info" id="profile-tab" data-bs-toggle="tab" href="#myPending" role="tab" aria-controls="profile" aria-selected="false">My Pending</a>
				</li>

				<li class="nav-item" role="presentation">
					<a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#mydrafts" role="tab" aria-controls="profile" aria-selected="false">My Drafts</a>
				</li>

				<li class="nav-item" role="presentation">
					<a class="nav-link text-success" id="profile-tab" data-bs-toggle="tab" href="#approved" role="tab" aria-controls="profile" aria-selected="false">My Approved</a>
				</li>


				<li class="nav-item" role="presentation">
					<a class="nav-link text-danger" id="profile-tab" data-bs-toggle="tab" href="#rejected" role="tab" aria-controls="profile" aria-selected="false">My Rejected</a>
				</li>


			</ul>
			<div class="tab-content" id="myTabsContent">
				<div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="home-tab">
					<h5 class="mt-2 mb-2">Staff Pending Expenses</h5>
					@if ($pendings->isEmpty())
					<p>No expenses found.</p>
					@else
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
								<td>{{ $expense->category }}</td>route('expense.details.id', ['id' => $expenseId]);

								<td><a href="route('expense.details.id', ['id' => $expenseId])" class="btn btn-sm btn-info">View</a></td>	
							</tr>
							@endforeach

						</tbody>
					</table>
					@endif
				</div>


				<div class="tab-pane fade" id="myPending" role="tabpanel" aria-labelledby="profile-tab">
					<h5 class="mt-2 mb-2">My Pending Expenses</h5>
					@if ($manager_pendings->isEmpty())
					<p>No expenses found.</p>
					@else
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
							@foreach ($manager_pendings as $expense)
							<tr>
								<td>{{ $serialNumber++ }}</td>		
								<td>{{ $expense->created_at->format('Y-m-d') }}</td>
								<td>{{ $expense->amount }}</td>
								<td>{{ $expense->description }}</td>
								<td>{{ $expense->category }}</td>
								<td>
									<a href="detail/{{$expense->id}}" class="btn btn-sm btn-info">View</a>

									@if($expense->status==='accepted')
									<a href="/edit/{{$expense->id}}" class="btn btn-sm btn-primary">Edit</a>
									@endif
								</td>
								<td></td>	
							</tr>
							@endforeach

						</tbody>
					</table>
					@endif
				</div>




				<div class="tab-pane fade" id="mydrafts" role="tabpanel" aria-labelledby="profile-tab">
					<h5 class="mt-2 mb-2">My Draft Expenses</h5>
					@if ($manager_drafted->isEmpty())
					<p>No expenses found.</p>
					@else
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
							@foreach ($manager_drafted as $expense)
							<tr>
								<td>{{ $serialNumber++ }}</td>		
								<td>{{ $expense->created_at->format('Y-m-d') }}</td>
								<td>{{ $expense->amount }}</td>
								<td>{{ $expense->description }}</td>
								<td>{{ $expense->category }}</td>
								<td>
									<a href="detail/{{$expense->id}}" class="btn btn-sm btn-info">View</a>

									@if($expense->status==='drafted')
									<a href="/edit/{{$expense->id}}" class="btn btn-sm btn-primary">Edit</a>
									@endif
								</td>
								<td></td>	
							</tr>
							@endforeach

						</tbody>
					</table>
					@endif
				</div>



				<div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="profile-tab">
					<h5 class="mt-2 mb-2">Approved Expenses</h5>
					@if ($approveds->isEmpty())
					<p>No expenses found.</p>
					@else
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
							@foreach ($approveds as $expense)
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
					@endif
				</div>


				<div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="profile-tab">
					<h5 class="mt-2 mb-2">My Rejected Expenses</h5>
					@if ($rejected->isEmpty())
					<p>No expenses found.</p>
					@else
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
					@endif
				</div>
			</div>
		</div>