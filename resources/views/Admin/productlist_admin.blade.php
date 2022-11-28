@extends('Admin.layout_admin')
@section('main-content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Product</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('admin_dash')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Products</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                All Users
                <a href="{{route('product.create')}}" class="btn btn-outline-primary btn-sm float-end"> + Add Product</a>
            </div>
            @include('Session.session_data')
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Sale_Price</th>
                        <th>Brand</th>
                        <th>Image</th>
                        <th>ProductCode</th>
                        <th>Stocks</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @foreach ($products as $product)
                        <td>{{$product['name']}}</td>
                        <td>{{$product['price']}}</td>
                        <td>{{$product['sale_price']}}</td>
                        <td>{{$product['get_brands_data']['name']}}</td>
                        <td><img src="{{url('products').'/'.$product['image']}}" alt="{{$product['name'] ?? 'product-name'}}" width="50px" height="60px"/></td>
                        <td>{{$product['product_code']}}</td>
                        <td>{{$product['stock']}}</td>
                        <td>{{$product['description']}}</td>
                        <td>
                            <a href="{{route('product.edit',['product'=>$product['id']])}}" class="btn btn-sm btn-warning">show</a>
                            <a href="{{route('admin_changeProductStatus',['id'=>$product['id'],'status'=>$product['action']==1?0:1])}}" class="btn btn-sm btn-{{$product['action']==1?'danger':'success'}}">{{$product['action']==1?'Deactive':'Active'}}</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection