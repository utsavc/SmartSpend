@extends('layout.app') <!-- Extending the 'app' layout -->

@section('content') <!-- Starting the 'content' section -->

<div class="row container-fluid">
    @include('layout.sidelayout') <!-- Including a sidebar layout -->

    <div class="col-lg-10">

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('deleted'))
        <div class="alert alert-danger">
            {{ session('deleted') }}
        </div>
        @endif

        @if (Auth::user()->position === 'hod') <!-- Checking if the user's position is 'hod' -->
        @include('expense_details.hod') <!-- Including content for Head of Department (HOD) -->
        @endif

        @if (Auth::user()->position === 'manager') <!-- Checking if the user's position is 'manager' -->
        @include('expense_details.manager') <!-- Including content for Manager -->
        @endif

        @if (Auth::user()->position === 'staff') <!-- Checking if the user's position is 'staff' -->
        @include('expense_details.staff') <!-- Including content for Staff -->
        @endif

    </div>
</div>

@endsection <!-- Ending the 'content' section -->
