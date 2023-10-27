@extends('layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-2 mb-3">
        <div class="col-md-6 border p-5">
            <h3 class="text-center">Registration</h3>

            <form name="registration" method="post" action="{{ route('register.post')}}" onsubmit="return validateRegistration();">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" required value="{{ old('name') }}">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" required value="{{ old('email') }}">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" required>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input name="password_confirmation" type="password" class="form-control" required>
                </div>

                @if ($department->count() > 0)
                <div class="mb-3">
                    <label class="form-label">Department</label>
                    <select name="department" class="form-select @error('department') is-invalid @enderror" aria-label="Default select example" required>
                        <option value="" selected>Select Department</option>
                        @foreach($department as $dep)
                        <option value="{{ $dep->department }}" {{ old('department') == $dep->department ? 'selected' : '' }}>{{ $dep->department }}</option>
                        @endforeach
                    </select>
                    @error('department')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                @else
                @if ($user > 0)
                <div class="alert alert-danger">
                    Please wait for the department to be added
                </div>
                @endif
                @endif

                <div class="mt-4">
                    <button type="submit" class="btn btn-sm btn-danger">Submit</button>
                </div>

                @if (session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
                @endif

            </form>
        </div>
    </div>
</div>
@endsection
