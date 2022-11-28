@extends('Admin.layout_admin')
@section('main-content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard-Data</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white  px-5">
                    <div class="card-body bg-white text-black rounded fw-bold ">Total Users</div>
                    <div class="card-body rounded-circle bg-white text-black pt-5 pb-5 m-3 text-center fw-bold"><h1>{{$totalUsers}}</h1></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white px-5">
                    <div class="card-body bg-white text-black rounded fw-bold ">Total Brands</div>
                    <div class="card-body rounded-circle bg-white text-black pt-5 pb-5 m-3 text-center fw-bold"><h1>{{$totalBrands}}</h1></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white  px-5">
                    <div class="card-body  bg-white text-black rounded fw-bold">Total Orders</div>
                    <div class="card-body rounded-circle bg-white text-black pt-5 pb-5 m-3 text-center fw-bold"><h1>{{$totalOrders}}</h1></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white px-5">
                    <div class="card-body bg-white text-black rounded fw-bold ">Total Sales Amount</div>
                    <div class="card-body rounded-circle bg-white text-black pt-5 pb-5 m-3 text-center"><h1>{{$totalSaleAmounts}}</h1></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Area Chart Example
                    </div>
                    <div class="card-body">
                        <canvas id="myAreaChart" width="100%" height="40"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Bar Chart Example
                    </div>
                    <div class="card-body">
                        <canvas id="myBarChart" width="100%" height="40"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection