@extends('Admin.layout_admin')
@section('main-content')
<div class="container-xl px-4 mt-4">
    <h1 class="mt-4">Brands</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('admin_dash')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{route('brand.index')}}">Brands</a></li>
            <li class="breadcrumb-item active">Show-Brand</a></li>
        </ol>
    <!-- Account page navigation-->
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header bg-success text-white"><h5>Profile Picture</h5></div>
                <div class="card-body">
                    <div class="row mb-3">
                    <!-- Profile picture image-->
                    <img class="img-account-profile " style="background-attachment: fixed;backgroun-size:cover; height:200px; width:300px; margin:10px auto;" src="{{url('brands').'/'.$brand->image}}" alt="Brands Image" />
                    <form method="POST" action="{{route('admin_changeBrandImage',$brand->id)}}" enctype="multipart/form-data">
                        @csrf
                            <div class="col">
                                <input type="file" class="form-control-file" name="image" id="image">
                            </div>                           
                        <br>
                        <div class="col">
                            <input type="submit" name="update" id="update" value="UpdateImage"
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
                <div class="card-header bg-success text-white"><h5>Brand Details</h5></div>
                <div class="card-body">
                    <form method="POST" action="{{route('brand.update',$brand->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col">
                                <label for="name" class="form-label">Brand Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{$brand->name}}"
                                       required="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" rows="3" name="description"
                                          placeholder="description" required="">{{$brand->description}}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="mb-3">
                            <input type="submit" name="update" id="update" value="Update"
                                   class="btn btn-outline-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection