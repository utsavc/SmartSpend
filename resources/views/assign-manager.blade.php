@extends('layout.app') 
@section('content') 
<div class="container-fluid row">

    @include('layout.sidelayout')

    <div class="col-lg-6 mt-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">User List</h4>

                <form action="{{ route('assign-manager.post', ['id' => $users->id]) }}" method="post">

                    
                    @csrf

                    <input type="hidden" name="id" value="{{$users->id}}">

                    <div class="mb-3">
                        <label class="form-label">Manager</label>
                        <select name="manager_id" class="form-select @error('position') is-invalid @enderror" aria-label="Default select example" required>
                            <option>Select Manager</option>
                            @foreach ($managers as $manager)
                            <option value="{{$manager->id}}">{{$manager->name}}</option>
                            @endforeach

                        </select>
                        @error('user')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <button class="btn btn-sm btn-primary"> Assign Manager</button>

                </form>


            </div>
        </div>
    </div>
</div>

@endsection