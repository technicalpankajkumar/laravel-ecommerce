@extends('layout_user')

@section('css')
<style>
    .form-group {
        margin-bottom: 1rem;
    }

    .form-inline .form-control {
        display: inline-block;
        width: auto;
        vertical-align: middle;
    }

    .form-row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -5px;
        margin-left: -5px;
    }

    label {
        margin-bottom: 0.5rem;
    }
</style>
@endsection

@section('main-containt')

<!-- Header-->
<header class="bg-dark pt-5 pb-2">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shop in style</h1>
            <p class="lead fw-normal text-white-50 mb-0">With ShopsStore</p>
        </div>
    </div>
</header>
<section class="py-0">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="card box" style="width: 75rem;">
            <h5 class="card-header bg-success text-white fw-bold">FILTER BY</h5>
            <div class="card-body">
                <form name="search_by_detail" action="{{route('view_products')}}" method="get" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md m-1">
                            <label><b>Gender:</b></label>
                            <select class="form-select" name="gender" id="gender" aria-label="gender filter">
                                <option selected disabled>Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Children">Chidren</option>
                                <option value="All">All</option>
                            </select>
                        </div>
                        <div class="form-group col-md m-1">
                            <label><b>Price:</b></label>
                            <select class="form-select" name="price" id="price" aria-label="price filter">
                                <option selected disabled>Select</option>
                                <option value="less_than_1500">Less than ₹1500</option>
                                <option value="between_1500_5k">₹1500 - ₹5000</option>
                                <option value="between_5k_10k">₹5000 - ₹10,000</option>
                                <option value="between_10k_30k">₹10,000 - ₹30,000</option>
                                <option value="greater_than_30k">More than ₹30,000</option>
                            </select>
                        </div>
                        <div class="form-group col-md m-1">
                            <label><b>Color:</b></label>
                            <select class="form-select" name="color" id="color" aria-label="color filter">
                                <option selected disabled>Select</option>
                                <option value="gold">Gold</option>
                                <option value="aqua">Aqua</option>
                                <option value="silver">Silver</option>
                                <option value="black">Black</option>
                                <option value="blue">Blue</option>
                                <option value="green">Green</option>
                            </select>
                        </div>
                        <div class="form-group col-md m-1">
                            <label><b>Function:</b></label>
                            <select class="form-select" name="function" id="function" aria-label="function filter">
                                <option selected disabled>Select</option>
                                @foreach ($functions as $function)
                                    <option value="{{$function}}">{{$function}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md m-1">
                            <label><b>Brand:</b></label>
                            <select class="form-select" name="brand" id="brand" aria-label="brand filter">
                                <option selected disabled>Select</option>
                                @foreach ($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md m-1">
                            <label><b>Sort By:</b></label>
                            <select class="form-select" name="sort_by" id="sort_by" aria-label="sort filter">
                                <option selected disabled>Select</option>
                                <option value="lower_to_higher">Price Lower to Higher</option>
                                <option value="higher_to_lower">Price Higher to Lower</option>
                                <option value="model_a_z">Model (A-Z)</option>
                                <option value="model_z_a">Model (Z-A)</option>
                            </select>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <input type="submit" class="btn btn-success btn-sm" name="search" value="Search" id="search"
                               style="width:8rem;color: #ffffff">
                        <input type="reset" class="btn btn-warning btn-sm" name="reset_filters" value="Clear Filters" id="reset_filters"
                               style="width:8rem;color: #ffffff">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Section-->
<section class="py-0 pb-3">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach ($products as $product )
            <div class="col mb-5">
                <div class="card h-100">
                    @if(empty($product['stock']))
                    <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem">OutOfStock
                    </div>
                    @else
                    @if(!empty($product['sale_price']))
                    <div class="badge bg-primary text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale
                    </div>
                    @endif
                    @endif
                    <!-- Product image-->
                    <img class="card-img-top" src="{{url('/products').'/'.$product['image']}}" alt="{{$product['image']}}" height="250px" width="180px" />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">{{$product['name']}}</h5>
                            <!-- Product price-->
                            @if(!empty($product['sale_price']) && $product['sale_price']!=0)
                            <span class="text-muted text-decoration-line-through">{{'₹'.$product['price']}}</span>
                            {{'₹'.$product['sale_price']}}
                            @else
                            {{'₹'.$product['price']}}
                            @endif
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{route('product_info',$product['id'])}}">View Product</a></div>
                    </div>
                </div>
            </div>    
            @endforeach
            {{-- pagination is here --}}
            {{-- <nav aria-label="pagination ">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav> --}}
        </div>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            {{$products->links('pagination::bootstrap-4')}}
        </div>
    </div>
</section>
@endsection
