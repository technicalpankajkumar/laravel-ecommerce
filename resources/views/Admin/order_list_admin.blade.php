@extends('Admin.layout_admin')
@section('main-content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Orders</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('admin_dash')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Orders</li>
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
                        <th>Tax Rate %</th>
                        <th>Shipp.Charge</th>
                        <th>Tax Amount</th>
                        <th>Total Price</th>
                        <th>Total Amount</th>
                        <th>Comment</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @foreach ($orders as $order)
                        <td>LV-OD{{$order->id}}</td>
                        <td>{{$order->userData->full_name}}</td>
                        <td>{{$order->tax_rate}}</td>
                        <td>{{$order->shipping_charge}}</td>
                        <td>{{$order->including_tax}}</td>
                        <td>{{$order->total_price}}</td>
                        <td>{{$order->total_amount}}</td>
                        <td>{{$order->comment}}</td>
                        <td>{{$order->status}}</td>
                        <td style="max-width: 30px">
                            <form action="{{route('admin_changeOrderStatus', $order->id)}}" method="get">
                                @csrf
                                <select class="form-select" id="status"
                                aria-label="Default select example"
                                required="" name="status">
                                <option selected disabled>--Select--</option>
                                @foreach (Config::get('order_status_admin'); as $status )
                                <option value="{{$status}}" @if ($status==$order->status) {{'selected'}} @endif>{{$status}}</option>
                                @endforeach
                                </select>
                                <input type="submit" value="Update" name="update" class="btn btn-sm btn-primary">
                            </form>
                            <a href="{{route('admin_lineItems',['id'=>$order->id])}}" class="btn btn-sm btn-success">ListItem</a>
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