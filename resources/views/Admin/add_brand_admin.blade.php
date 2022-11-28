@extends('Admin.layout_admin')
@section('main-content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Brands</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('admin_dash')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{route('brand.index')}}">Brands-List</a></li>
            <li class="breadcrumb-item active">Add-Brands</li>
        </ol>
        <div class="container-fluid">
            <!-- Start col -->
            <div class="album " style="height:60vh; margin-left:150px">
                <div class="row h-70">
                    <div class="card border-success ml-4" style="max-width: 65rem;padding: 2%;">
                        <div>
                            <center><h2>Add New Brand</h2></center>
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
                            <form method="POST" action="{{route('brand.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="name" class="form-label">Brand Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="Brand Name"
                                               required="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" rows="3" name="description"
                                                  placeholder="description" required=""></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="image" class="form-label">Image</label><br>
                                        <input type="file" class="form-control-file" name="image" id="image">
                                    </div>
                                </div>
                                <br>
                                <div class="mb-3">
                                    <input type="submit" name="add" id="add" value="add"
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