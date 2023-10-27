<div class="row">
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2 bg-info">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-white text-uppercase mb-1">
						Waiting for Approval</div>
						<div class="h5 mb-0 font-weight-bold text-white">{{$pendings}}</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-calendar fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-warning shadow h-100 py-2 bg-success">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-white text-uppercase mb-1">
						Approved Expenses</div>
						<div class="h5 mb-0 font-weight-bold text-white">{{$approveds}}</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-comments fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-warning shadow h-100 py-2 bg-primary">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-white text-uppercase mb-1">
						Accepted Expenses</div>
						<div class="h5 mb-0 font-weight-bold text-white">{{$accepted}}</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-comments fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>


</div>

<div class="card border-left-warning shadow h-100 py-2 bg-faded">
	<div class="card-body">
		<div class="row no-gutters align-items-center">
			<div class="col mr-2">
				<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
				Total Submitted Expenses</div>
				<div class="h3 mb-0 font-weight-bold">{{$accepted+$approveds+$pendings}}</div>
			</div>
			<div class="col-auto">
				<i class="fas fa-comments fa-2x text-gray-300"></i>
			</div>
		</div>
	</div>
</div>