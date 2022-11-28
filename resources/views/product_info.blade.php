@extends('layout_user')
@section('main-containt')
<!-- Product section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                <img class="card-img-top mb-5 mb-md-0" src="{{url('/products').'/'.$productInfo->image}}" alt="{{$productInfo->image}}" height="400px" /></div>
            <div class="col-md-6">
                <div class="small mb-1">{{$productInfo->product_code}}</div>
                <h1 class="display-5 fw-bolder">{{$productInfo->name}}</h1>
                <div class="fs-5 mb-3">
                 @if(!empty($productInfo->sale_price))
                    <span class="text-decoration-line-through">{{'₹'.$productInfo->price}}</span>
                    <span>{{'₹'.$productInfo->sale_price}}</span>
                @else
                <span>{{'₹'.$productInfo->price}}</span>
                @endif
                </div>
                <div>
                <p class="lead">{{$productInfo->description}} </p>
                <div class="d-flex">
                    {{-- add to cart code --}}
                    <form action="{{route('add_to_cart')}}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$productInfo->id}}"/>
                        <input class="form-control text-center me-3" id="inputQuantity" type="num" name="quantity" value="1" min="1" style="max-width: 3rem" />
                        <input class="btn btn-outline-dark flex-shrink-0" type="submit" value="Add to cart">
                    </form>
                </div>
                {{-- warring message is here --}}
                    @if(empty($productInfo->stock))
                    <button class="mt-3 w-50 fw-bold border-0 bg-warning fs-3 p-0 rounded" style="height: 50px">
                    <span class="text-danger">!! OutOfStock !!</span>
                    @else
                        @if(!empty($productInfo->sale_price))
                        <button class="mt-3 w-50 fw-bold border-0 bg-warning fs-3 p-0 rounded" style="height: 50px">
                        <span class="text-primary">!! Sale Running !!</span>
                        </button>
                        @endif
                    @endif
                {{-- warring message is end here --}}
            </div>
        </div>
    </div>
</section>
<!-- Related items section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Related products in {{$productInfo->gender}}</h2>
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
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{$product['id']}}">View Product</a></div>
                    </div>
                </div>
            </div>    
            @endforeach
        </div>
    </div>
</section>
@include('store_locater')
@endsection