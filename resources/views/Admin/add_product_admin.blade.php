@extends('Admin.layout_admin')
@section('main-content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Products</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('admin_dash')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{route('product.index')}}">Products-List</a></li>
            <li class="breadcrumb-item active">Add-Product</li>
        </ol>
        <div class="container-fluid">
            <!-- Start col -->
            <div class="album " style="height:60vh; margin-left:150px">
                <div class="row h-70">
                    <div class="card border-success" style="max-width: 65rem;padding: 2%; box-sizing:border-box">
                        <div class="card-body">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                        {{ $error }}<br>
                                @endforeach
                            </div>
                            @endif
                            @include('Session.session_data')
                            <form method="POST" action="{{route('product.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="name" class="form-label">Product Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="Product Name"
                                               required="">
                                    </div>
                                    <div class="col">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="text" class="form-control" id="price" name="price"
                                               placeholder="15000"
                                               required="">
                                    </div>
                                    <div class="col">
                                        <label for="sale_price" class="form-label">Sale Price</label>
                                        <input type="text" class="form-control" id="sale_price"
                                               name="sale_price"
                                               placeholder="10000">
                                    </div>
                                    <div class="col">
                                        <label for="color" class="form-label">Color</label>
                                        <input type="text" class="form-control" id="color" name="color"
                                               placeholder="Rose Gold"
                                               required="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="brand" class="form-label">Brand</label>
                                        <select class="form-select" id="brand"
                                                aria-label="Default select example"
                                                required="" name="brand_id">
                                                <option selected disabled>--Select--</option>
                                                @foreach ($brands as $brand )
                                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="product_code" class="form-label">Product Code</label>
                                        <input type="text" class="form-control" id="product_code"
                                               name="product_code"
                                               value="Lv-123"
                                               required="">
                                    </div>
                                    <div class="col">
                                        <label for="gender" class="form-label">Gender</label><br>
                                        <input type="radio" id="gender" name="gender" value="Male">&nbsp;&nbsp;Male&nbsp;&nbsp;
                                        <input type="radio" id="gender" name="gender" value="Female">&nbsp;&nbsp;Female&nbsp;
                                        <input type="radio" id="gender" name="gender" value="Children">&nbsp;&nbsp;Children&nbsp;
                                        <input type="radio" id="gender" name="gender" value="All" checked>&nbsp;&nbsp;All
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <label for="function" class="form-label">Function</label>
                                        <select class="form-select" id="function"
                                                aria-label="Default select example"
                                                required="" name="function">
                                            <option selected disabled>--Select--</option>
                                            @foreach ($configs as $config)
                                                <option value="{{$config}}">{{$config}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="stock" class="form-label">Stock</label>
                                        <input type="number" class="form-control" id="stock" name="stock"
                                               placeholder="100"
                                               required="">
                                    </div>
                                    <div class="col">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" rows="3"
                                                  name="description"
                                                  placeholder="description" required=""></textarea>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <label for="image" class="form-label">Image</label><br>
                                        <input type="file" class="form-control-file" name="image"
                                               id="image" required accept="image/*">
                                    </div>
                                </div>
                                <br>
                                <div class="mb-0">
                                   <center> <input type="submit" name="add_product" id="add_product"
                                           value="Add Product"
                                           class="btn btn-outline-success">
                                   </center>
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