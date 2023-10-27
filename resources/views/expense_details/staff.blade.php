
<div class="container mt-5">
	<h5 class="mt-2 mb-2">My Expenses</h5>
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
				<th scope="col">Status</th>
				<th>Operation</th>
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
				<td>
					@if($expense->status==='accepted')
					<span class="text-success">Accepted by Manager</span>
					@elseif($expense->status==='approved')
					<span class="text-success">Approved by HOD</span>
					@elseif($expense->status==='rejected_hod' || $expense->status==='rejected_manager')
					<span class="text-danger">{{$expense->status}}</span>
					@else
					<span class="text-primary">{{$expense->status}}</span>					
					@endif
				</td>
				<td>
					@if($expense->status==='drafted' || $expense->status=='pending')
					<a href="/edit/{{$expense->id}}" class="btn btn-sm btn-primary">Edit</a>
					@else
					-
					@endif
				</td>
			</tr>
			@endforeach

		</tbody>
	</table>
	@endif
</div>