@extends('Admin.layout_admin')
@section('main-content')
<div class="container-xl px-4 mt-4">
    <h1 class="mt-4">Users</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('admin_dash')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{route('admin_userlist')}}">Users</a></li>
            <li class="breadcrumb-item active">Show-User</a></li>
        </ol>
    <!-- Account page navigation-->
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header"><h5>Profile Picture</h5></div>
                <div class="card-body">
                    <div class="row mb-3">
                    <!-- Profile picture image-->
                    <img class="img-account-profile rounded-circle " style="background-attachment: fixed;backgroun-size:cover; height:250px; width:300px; margin:auto;" src="{{url('uploads').'/'.$img=$user->profile}}" alt="Profile Image" />
                    <form method="POST" action="{{route('admin_updateUsersProfile',$user->id)}}" enctype="multipart/form-data">
                        @csrf
                            <div class="col">
                                <input type="file" class="form-control-file" name="profile" id="profile">
                            </div>                           
                        <br>
                        <div class="col">
                            <input type="submit" name="updateImg" id="updateImg" value="Update Image"
                                   class="btn btn-outline-success">
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header"><h5>Account Details</h5></div>
                <div class="card-body">
                    <form method="POST" action="{{route('admin_updateUsers',$user->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                       value="{{$user->first_name}}"
                                       required="">
                            </div>
                            <div class="col">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                      value="{{$user->last_name}}"
                                       required="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                value="{{$user->email}}" disabled>
                            </div>
                            <div class="col">
                                <label for="contact" class="form-label">Contact Number</label>
                                <input type="tel" class="form-control" id="contact" name="contact"
                                value="{{$user->contact}}"required="">
                            </div>
                        </div>
                        <div class="row mb-3"> 
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="gender" class="form-label">Gender</label><br>
                                        <input type="radio" id="gender" name="gender" value="Male" @if($user->gender=='Male') checked @endif>&nbsp;Male
                                        <input type="radio" id="gender" name="gender" value="Female" @if($user->gender=='Female') checked @endif>&nbsp;Female
                                    </div>
                                    <div class="col-6">
                                        <label for="role_id" class="form-label">Roles</label><br>
                                        <input type="radio" id="role_id" name="role_id" value=1 @if($user->role_id==1) checked @endif>&nbsp;Admin
                                        <input type="radio" id="role_id" name="role_id" value=0 @if($user->role_id==0) checked @endif>&nbsp;User
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                            <label for="inputCountry" class="form-label">Country</label>
                            <select class="form-select" id="inputCountry"
                                    aria-label="Default select example" name="country"
                                    required="">
                                <option selected disabled>Select</option>
                                @foreach ($country as $countries)
                                <option value="{{$countries->id}}" @if ($user->country==$countries->id) selected @endif>{{$countries->name}}</option>
                                @endforeach                                    
                            </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" rows="3" name="address"
                                          placeholder="address" required="">{{$user->address}}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="mb-3">
                            <input type="submit" name="update" id="update" value="Update Profile"
                                   class="btn btn-outline-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection