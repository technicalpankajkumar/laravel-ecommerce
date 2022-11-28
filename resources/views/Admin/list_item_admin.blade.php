@extends('Admin.layout_admin')
@section('main-content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Orders</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('admin_dash')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{route('admin_order_list')}}">Orders</a></li>
            <li class="breadcrumb-item active">List-Items</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <i class="fas fa-table me-1"></i>
                All Orders
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>User Name</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Tax</th>
                        <th>Comment</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @foreach ($ordersData->getLineItems as $lineItem)
                        <td>LV-OD{{$lineItem->id}}</td>
                        <td>{{$lineItem->getUserData->full_name}}</td>
                        <td>{{$lineItem->getProductData->name}}</td>
                        <td>{{$lineItem->price}}</td>
                        <td>{{$lineItem->quantity}}</td>
                        <td>{{$ordersData->tax_rate}}%</td>
                        <td>{{$lineItem->getUserData->getComment->comment ?? 'comment null'}}</td>
                        <td>{{$ordersData->status}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection