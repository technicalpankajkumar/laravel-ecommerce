@extends('layout_user')

@section('main-containt')
<!-- Header-->
<div class="container-fluid">
    <!-- Start col -->
    <div class="album py-5" >
        <div class="row h-100 justify-content-center align-items-center">
            <div class="card border-success" style="margin-top: 2%;max-width: 35rem;padding: 2%;">
                <h2> Login </h2>
                @include('Session.session_data')
                <hr>
                <div class="card-body">
                    <form action="{{route('Authenticate')}}" method="POST" name="loginForm" enctype="multipart/from-data">
                        @csrf
                        <div class="form-group">
                            <label for="emailInput">Email address:</label>
                            <input type="email" class="form-control" name="email" id="email"
                                   required="required" placeholder="Enter email">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="passInput">Password:</label>
                            <input type="password" class="form-control" name="password" id="password"
                                   required="required" placeholder="Password">
                        </div>
                        <br>
                        <center>
                            <input type="submit" name="login" class="btn btn-outline-success" value="Login">
                            <input type="reset" class="btn btn-outline-danger" value="Reset">
                        </center>
                    </form>
                    <div style="margin-top: -8%;">
                        <a href="{{route('register')}}" class="float-end">New User?</a><br>
                        <a href="{{route('forgetPassword')}}" class="float-end">Forgot Password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('store_locater')
@endsection