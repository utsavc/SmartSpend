@extends('layout.app')

@section('content')
<div class="row container-fluid">

    @include('layout.sidelayout')

    <div class="col-lg-10 mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Change Password</div>

                        <div class="card-body">
                            @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif

                            <form method="POST" action="{{ route('change-password.post')}}">
                                @csrf

                                <div class="form-group">
                                    <label for="old_password">Old Password</label>
                                    <input type="password" id="old_password" name="old_password" class="form-control @error('old_password') is-invalid @enderror">
                                    @error('old_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Confirm New Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                                </div>

                                <div class="form-group mt-2">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
