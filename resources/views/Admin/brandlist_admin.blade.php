@extends('Admin.layout_admin')
@section('main-content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Brands</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('admin_dash')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Brands</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <i class="fas fa-table me-1"></i>
                All Users
                <a href="{{route('brand.create')}}" class="btn btn-outline-warning btn-sm float-end"> + Add Brand</a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                    <tr>
                        <th>Brand Name</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @foreach ($brands as $brand)
                        <td>{{$brand->name}}</td>
                        <td>{{$brand->description}}</td>
                        <td><img src="{{url('brands').'/'.$brand->image}}" alt="{{$brand->name ?? 'brand-name'}}" width="100px" height="50px"/></td>
                        <td style="max-width: 30px">
                            <a href="{{route('brand.edit',['brand'=>$brand->id])}}" class="btn btn-sm btn-warning">show</a>
                            <a href="{{route('admin_changeBrandStatus',['id'=>$brand->id,'status'=>$brand->action==1?0:1])}}" class="btn btn-sm btn-{{$brand->action==1?'danger':'success'}}">{{$brand->action==1?'Deactive':'Active'}}</a>
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