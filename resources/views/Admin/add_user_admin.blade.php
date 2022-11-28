@extends('Admin.layout_admin')
@section('main-content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Users</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('admin_dash')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{route('admin_userlist')}}">UserList</a></li>
            <li class="breadcrumb-item active">Add-User</li>
        </ol>
        <div class="container-fluid">
            <!-- Start col -->
            <div class="album " style="height:100vh; margin-left:150px">
                <div class="row h-70">
                    <div class="card border-success ml-4" style="max-width: 65rem;padding: 2%;">
                        <div>
                            <center><h2>Add New User</h2></center>
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                            @endif
                            @include('Session.session_data')
                        </div>
                        <hr>
                        <div class="card-body">
                            <form method="POST" action="{{route('admin_addUser')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="first_name" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                               placeholder="First Name"
                                               required="">
                                    </div>
                                    <div class="col">
                                        <label for="last_name" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                               placeholder="Last Name"
                                               required="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                               placeholder="name@example.com" required="">
                                    </div>
                                    <div class="col">
                                        <label for="contact" class="form-label">Contact Number</label>
                                        <input type="tel" class="form-control" id="contact" name="contact"
                                               placeholder="1234567890" required="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="password" class="form-label">Password</label><br>
                                        <input type="password" class="form-control" id="password" name="password"
                                               placeholder="password" required="">
                                    </div>
                                    <div class="col">
                                        <label for="gender" class="form-label mt-2">Gender</label><br>
                                        <input type="radio" id="gender" name="gender" value="Male" checked>&nbsp;Male&nbsp;
                                        <input type="radio" id="gender" name="gender" value="Female">&nbsp;Female
                                    </div>
                                    <div class="col">
                                        <label for="role_id" class="form-label mt-2">Role ID</label><br>
                                        <input type="radio" id="role_id" name="role_id" value="1" checked>&nbsp;Admin&nbsp;
                                        <input type="radio" id="role_id" name="role_id" value="0">&nbsp;User
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea class="form-control" id="address" rows="3" name="address"
                                                  placeholder="address" required=""></textarea>
                                    </div>
                                    <div class="col">
                                        <label for="inputCountry" class="form-label">Country</label>
                                        <select class="form-select" id="inputCountry"
                                                aria-label="Default select example"
                                                required="" name="country">
                                            <option selected disabled>Select</option>
                                            @foreach ( $country as $countries)
                                            <option value="{{$countries->id}}">{{$countries->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="profile" class="form-label">Profile</label><br>
                                        <input type="file" class="form-control-file" name="profile" id="profile">
                                    </div>
                                </div>
                                <br>
                                <div class="mb-3">
                                    <input type="submit" name="register" id="register" value="Register"
                                           class="btn btn-outline-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection