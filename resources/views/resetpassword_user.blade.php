@extends('layout_user')

@section('main-containt')

<!-- Header-->
<div class="container-fluid">
    <!-- Start col -->
    <div class="album py-5">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="card border-success" style="margin-top: 2%;max-width: 35rem;padding: 2%;">
                <div>
                    <h2>Forgot Password</h2>
                    <a href="{{route('login')}}" class="float-end btn btn-outline-dark" style="margin-top: -9%;">Login</a>
                </div>
                <hr>
                <div class="card-body">
                    <form action="{{route('resetPasswordData')}}" method="POST" name="forgotPassForm" enctype="multipart/from-data">
                        @csrf
                        <div class="form-group">
                            <col class="row md-3">
                                <div class="col pb-3">
                                    <input type="hidden" name="email" value="{{$email}}"/>
                                    <input type="password" class="form-control" name="password" id="password"
                                   required="required" placeholder="Enter new password">
                                </div>
                                <div class="col">
                                    <input type="password" class="form-control" name="password_confirm" id="password_confirm"
                                   required="required" placeholder="Enter password again">
                                </div>
                            </div>
                        </div>
                        <br>
                        <center>
                            <input type="submit" name="forget_pass" class="btn btn-outline-success"
                                   value="Reset Password">
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('store_locater')
@endsection