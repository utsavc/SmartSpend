@extends('layout.app') 
@section('content') 
<div class="row container-fluid">

    @include('layout.sidelayout')


    <div class="col-lg-10 mt-2">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">User Profile</h4>
                        <div class="mb-3">
                            <label for="firstName" class="form-label">First Name:</label>
                            <input type="text" class="form-control" id="firstName" value="{{$user->name}}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" value="{{$user->email}}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="position" class="form-label">Position:</label>
                            <input type="text" class="form-control" id="position" value="{{$user->position}}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="department" class="form-label">Department:</label>
                            <input type="text" class="form-control" id="department" value="{{$user->department}}" readonly>
                        </div>

                        <a href=" {{route('change-password')}}" class="btn btn-sm btn-primary">Change Password</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection