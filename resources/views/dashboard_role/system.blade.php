<div class="row">
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2 bg-dark">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-white text-uppercase mb-1">
						HOD</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800 text-white">{{$hodCount}}</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-calendar fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-success shadow h-100 py-2" style="background: #101582;">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-white text-uppercase mb-1">
						Manager</div>
						<div class="text-white h5 mb-0 font-weight-bold text-gray-800">{{$managerCount}}</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Pending Requests Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-warning shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
						Staff</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">{{$staffCount}}</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-comments fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="row container-fluid">	
		<h3>Expenses Summary</h3>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2 bg-success text-white">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-white text-uppercase mb-1">
							Approved</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800">{{$approved}}</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-calendar fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2 bg-warning text-white">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-white text-uppercase mb-1">
							Pending</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800">{{$pending}}</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-calendar fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2 bg-info text-white">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-white text-uppercase mb-1">
							Submitted</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalCount}}</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-calendar fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

