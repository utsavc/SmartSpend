<style>
	.no-underline {
		text-decoration: none;
	}

	.activate{
		text-decoration: underline;
	}
</style>

<div class="col-lg-2 bg-dark text-center p-3 text-white" style="min-height: 685px;">
	<span><a class="nav-link text-white" href="/profile/{{ Auth::user()->id}}">Welcome <b>{{ Auth::user()->name}}</b></a></span>
	<hr>
	<a class="text-white d-block border-bottom p-2 no-underline {{ request()->is('dashboard') ? 'activate' : '' }}" href="{{ route('dashboard')}}">Dashboard</a>

	@if (Auth::user()->position == 'system_manager' || Auth::user()->position == 'hod' )
	<a class="text-white d-block border-bottom p-2 no-underline {{ request()->is('/user-management') ? 'activate' : '' }}" href="{{ route('user-management') }}">User Management</a>
	@endif


	@if (Auth::user()->position == 'staff' || Auth::user()->position == 'manager' )
	<a class="text-white no-underline border-bottom p-2 d-block" href="{{ route('expense') }} ">Expense</a>
	@endif


	@if (Auth::user()->position != 'system_manager' )
	<a class="text-white no-underline border-bottom p-2 d-block" href="{{ route('expense.details') }}">Expense Details</a>
	@endif

	@if (Auth::user()->position == 'system_manager' )
	<a class="text-white no-underline border-bottom p-2 d-block" href="{{ route('department')}} ">Department</a>
	<a class="text-white no-underline border-bottom p-2 d-block" href="{{ route('master-expense') }} ">Master Expense</a>
	@endif

	<a class="text-info d-block border-bottom p-2 no-underline" href="{{ route('profile', ['id' => Auth::user()->id]) }}">Profile</b></a>
</div>