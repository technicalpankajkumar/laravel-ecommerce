@extends('layout_user')

@section('main-containt')

<!-- Header-->
<div class="container-fluid">
    <!-- Start col -->
    <div class="album py-5">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="card border-success" style="margin-top: 2%; max-width: 35rem;padding: 2%;">
                <div>
                    <h2>Forgot Password</h2>
                    <a href="{{route('login')}}" class="float-end btn btn-outline-dark" style="margin-top: -9%;">Login</a>
                </div>
                   @include('Session/session_data')
                <hr>
                <div class="card-body">
                    <form action="{{route('sendForgetPasswordEmail')}}" method="POST" name="forgotPassForm" enctype="multipart/from-data">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" id="email"
                                   required="required" placeholder="Enter email">
                        </div>
                        <br>
                        <center>
                            <input type="submit" name="forget_pass" class="btn btn-outline-success"
                                   value="Send Email">
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('store_locater')
@endsection