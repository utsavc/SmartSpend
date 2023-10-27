@extends('layout.app')  <!-- Extending the layout named 'app' -->

@section('content') <!-- Starting a section named 'content' -->

<div class="row container-fluid">

    @include('layout.sidelayout') <!-- Including a sidebar layout -->

    <div class="col-lg-10">

        <div class="container">   
            <h3>Dashboard</h3>

            <!-- Checking the user's position and including specific dashboard content based on the position -->

            @if (Auth::user()->position === 'hod')
            @include('dashboard_role.hod') <!-- Including content for Head of Department (HOD) -->
            @endif

            @if (Auth::user()->position === 'manager')
            @include('dashboard_role.manager') <!-- Including content for Manager -->
            @endif

            @if (Auth::user()->position === 'staff')
            @include('dashboard_role.staff') <!-- Including content for Staff -->
            @endif

            @if (Auth::user()->position === 'system_manager')
            @include('dashboard_role.system') <!-- Including content for System Manager -->
            @endif

        </div>

    </div>
</div>

@endsection <!-- Ending the 'content' section -->

