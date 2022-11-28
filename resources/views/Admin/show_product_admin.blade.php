@extends('Admin.layout_admin')
@section('main-content')
<div class="container-xl px-4 mt-4">
    <h1 class="mt-4">Products</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('admin_dash')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{route('product.index')}}">Products-List</a></li>
        <li class="breadcrumb-item active">Show-Product</li>
    </ol>   
    @if ($errors->any())
        <div class="alert alert-danger">
          @foreach ($errors->all() as $error )
                  {{$error}}
          @endforeach
        </div>
    @endif
    <!-- Account page navigation-->
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header bg-success text-white"><h5>Profile Picture</h5></div>
                <div class="card-body">
                    <div class="row mb-3">
                    <!-- Profile picture image-->
                    <img class="img-account-profile " style="background-attachment: fixed;backgroun-size:cover; height:200px; width:200px; margin:10px auto;" src="{{url('products').'/'.$product->image}}" alt="products Image" />
                    <form method="POST" action="{{route('admin_changeProductImage',$product->id)}}" enctype="multipart/form-data">
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
                <div class="card-header bg-success text-white"><h5>product Details</h5></div>
                <div class="card-body">
                    <form method="POST" action="{{route('product.update',$product->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="name" class="form-label">Product Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{$product->name}}"
                                               required="">
                                    </div>
                                    <div class="col">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="text" class="form-control" id="price" name="price"
                                            value="{{$product->price}}"
                                               required="">
                                    </div>
                                    <div class="col">
                                        <label for="sale_price" class="form-label">Sale Price</label>
                                        <input type="text" class="form-control" id="sale_price"
                                               name="sale_price"
                                               value="{{$product->sale_price}}">
                                    </div>
                                    <div class="col">
                                        <label for="color" class="form-label">Color</label>
                                        <input type="text" class="form-control" id="color" name="color"
                                        value="{{$product->color}}"
                                               required="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="brand" class="form-label">Brand</label>
                                        <select class="form-select" id="brand"
                                                aria-label="Default select example"
                                                required="" name="brand_id">
                                                @foreach ($brands as $brand )
                                                <option value="{{$brand->id}}" @if ($product->brand_id==$brand->id)
                                                     {{'Selected'}}
                                                @endif>{{$brand->name}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="product_code" class="form-label">Product Code</label>
                                        <input type="text" class="form-control" id="product_code"
                                               name="product_code"
                                               value="{{$product->product_code}}"
                                               required="">
                                    </div>
                                    <div class="col">
                                        <label for="gender" class="form-label">Gender</label><br>
                                        <input type="radio" id="gender" name="gender" value="{{'Male'}}" @if ($product->gender=='Male')
                                         {{'checked'}} @endif>&nbsp;&nbsp;Male&nbsp;&nbsp;
                                        <input type="radio" id="gender" name="gender" value="{{'Female'}}" @if ($product->gender=='Female') 
                                        {{'checked'}} @endif>&nbsp;&nbsp;Female&nbsp;
                                        <input type="radio" id="gender" name="gender" value="{{'Children'}}" @if ($product->gender=='Children') 
                                        {{'checked'}} @endif>&nbsp;&nbsp;Children&nbsp;
                                        <input type="radio" id="gender" name="gender" value="{{'All'}}" @if ($product->gender=='All') 
                                        {{'checked'}} @endif>&nbsp;&nbsp;All
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <label for="function" class="form-label">Function</label>
                                        <select class="form-select" id="function"
                                                aria-label="Default select example"
                                                required="" name="function">
                                            @foreach ($configs as $config)
                                                <option value="{{$config}}" @if ($config == $product->function)
                                                     {{'Selected'}}
                                                @endif>{{$config}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="stock" class="form-label">Stock</label>
                                        <input type="number" class="form-control" id="stock" name="stock"
                                               value="{{$product->stock}}"
                                               required="">
                                    </div>
                                    <div class="col">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" rows="3"
                                                  name="description"
                                                 required="">{{$product->description}}</textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="mb-0">
                                   <center> <input type="submit" name="update" id="update"
                                           value="UpdateProduct"
                                           class="btn btn-outline-success">
                                   </center>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection