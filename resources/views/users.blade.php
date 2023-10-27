@extends('layout.app') 
@section('content') 


<div class="row container-fluid">

    @include('layout.sidelayout')

    <div class="col-lg-10">
        <div class="row">
            <div class="mt-3 col-md-10 mx-auto">

                <h3>Users List</h3>

                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if (session('successess'))
                <div class="alert alert-info">
                    {{ session('successess') }}
                </div>
                @endif


                @if (session('exists'))
                <div class="alert alert-danger">
                    {{ session('exists') }}
                </div>
                @endif



                @if (Auth::user()->position === 'hod')

                <ul class="nav nav-tabs" id="myTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#staff" role="tab" aria-controls="home" aria-selected="true">Staff</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#manager" role="tab" aria-controls="profile" aria-selected="false">Manager</a>
                    </li>
                </ul>


                <div class="tab-content" id="myTabsContent">
                    <div class="tab-pane fade show active" id="staff" role="tabpanel" aria-labelledby="home-tab">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Department</th>
                                    <th >Operation</th>
                                    <!-- <th >Remarks</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @php $serialNumber = 1; @endphp
                                @foreach ($staff as $staffMember)

                                <td>{{ $serialNumber++ }}</td>
                                <td>{{ $staffMember->name }}</td>
                                <td>{{ $staffMember->department }}</td>
                                <td> 
                                    <a class="btn btn-sm btn-success" href="{{ route('promote-manager', ['id' => $staffMember->id]) }}">Promote to Manager</a>
                                    @if ($staffMember->manager_id === null)
                                    <a class="btn btn-sm btn-primary" href="{{ route('assign-manager', ['id' => $staffMember->id]) }}">Assign Manager</a>
                                    @endif

                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>

                </div>

                <div class="tab-pane fade" id="manager" role="tabpanel" aria-labelledby="profile-tab">

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Department</th>

                                <th >Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $serialNumber = 1; @endphp
                            @foreach ($managers as $member)
                            <tr>
                                <td>{{ $serialNumber++ }}</td>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->department }}</td>                    
                                <td>

                                   <form action="demote" class="form-inline" method="post">
                                    @csrf
                                    <div class="form-group d-flex align-items-center">
                                        <input type="hidden" name="id" value="{{$member->id}}">
                                        <label class="form-label mr-4">Choose Manager</label>
                                        <select name="manager_id" class="form-control ml-2 mr-2" style="width: 50%;">
                                            @foreach ($managers as $manager)
                                            @if($member->id != $manager->id)
                                            <option value="{{$manager->id}}">{{$manager->name}}</option>
                                            @endif
                                            @endforeach

                                        </select>
                                        <button class="btn btn-sm btn-danger">Demote</button>
                                    </div>
                                </form>
                            </td>



                        </tr>
                        @endforeach

                    </tbody>
                </table>


            </div>
        </div>


        @endif









        @if (Auth::user()->position === 'system_manager')


        <ul class="nav nav-tabs" id="myTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#staff" role="tab" aria-controls="home" aria-selected="true">Staff</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#manager" role="tab" aria-controls="profile" aria-selected="false">Manager</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#hod" role="tab" aria-controls="profile" aria-selected="false">HOD</a>
            </li>
        </ul>


        <div class="tab-content" id="myTabsContent">
            <div class="tab-pane fade show active" id="staff" role="tabpanel" aria-labelledby="home-tab">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Department</th>
                            <th >Promotion</th>
                            <!-- <th >Remarks</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @php $serialNumber = 1; @endphp
                        @foreach ($staffs as $staffMember)
                        <tr>
                            <td>{{ $serialNumber++ }}</td>
                            <td>{{ $staffMember->name }}</td>
                            <td>{{ $staffMember->department }}</td>
                            <td> 

                                <a class="btn btn-sm btn-success" href="{{ route('promote-hod', ['id' => $staffMember->id]) }}">HOD</a> 
                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>

            </div>


            <div class="tab-pane fade show" id="hod" role="tabpanel" aria-labelledby="home-tab">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Department</th>
                            <th >Operation</th>
                            <!-- <th >Remarks</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @php $serialNumber = 1; @endphp
                        @foreach ($hods as $staffMember)
                        <tr>
                            <td>{{ $serialNumber++ }}</td>
                            <td>{{ $staffMember->name }}</td>
                            <td>{{ $staffMember->department }}</td>
                            <td> 
                                <a class="btn btn-sm btn-warning" href="{{ route('demote-manager', ['id' => $staffMember->id]) }}">Demote to Manager</a> 
                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>

            </div>

            <div class="tab-pane fade" id="manager" role="tabpanel" aria-labelledby="profile-tab">

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Department</th>
                            <th >Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $serialNumber = 1; @endphp
                        @foreach ($managers as $member)
                        <tr>
                            <td>{{ $serialNumber++ }}</td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->department }}</td>  
                            <td> 
                                <a class="btn btn-sm btn-success" 
                                href="{{ route('promote-hod', ['id' => $member->id]) }}">Promote</a>
                            </td>                
                        </tr>
                        @endforeach

                    </tbody>
                </table>


            </div>
        </div>


        @endif

        






    </div>
</div>
</div>

@endsection