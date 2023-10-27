@extends('layout.app') 
@section('content') 
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">User List</h4>

                    <form action="/assign" method="post">
                        @csrf

                        <div class="mb-3">
                            <input type="hidden" name="staff_id" value="{{$staff_id}}">
                            <label class="form-label">Position</label>
                            <select name="manager_id" class="form-select @error('position') is-invalid @enderror" aria-label="Default select example" required>
                                <option selected>Select Manager</option>
                                @foreach ($managers as $manager)
                                <option value="{{$manager->id}}">{{$manager->name}}</option>
                                @endforeach
                            </select>
                            @error('manager_id')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <button class="btn btn-sm btn-primary"> Assign</button>
                        
                    </form>

                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection