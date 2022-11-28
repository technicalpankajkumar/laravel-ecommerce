@extends('layout_user')
@section('main-containt')
<div class="container" style="margin-top: 5%;margin-bottom: 5%">
    <!-- Start row -->
    <div class="row">
        <!-- Start col -->
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="card-title">Cart</h5>
                </div>
                @include('Session.session_data')
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 col-xl-8">
                            <div class="cart-container">
                                <div class="cart-head">
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Photo</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Price</th>
                                                <th scope="col" class="text-right">Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <form action="{{route('cart.store')}}" method="post">
                                            @csrf
                                            @foreach ($cartData as $cart)
                                            <tr> 
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td><img
                                                    src="{{url('/products').'/'.$cart->getProductData->image}}"
                                                    class="img-fluid" width="100px" alt="product"></td>
                                                <td>{{$cart->getProductData->name}}</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="hidden" class="form-control cart-qty"
                                                               name="cartId[]" id="cart{{$loop->iteration}}" value="{{$cart->id}}" style="width:100px" min="0">
                                                        <input type="number" class="form-control cart-qty"
                                                               name="cartQty[]" id="cartQty{{$loop->iteration}}" value="{{$cart->quantity}}" style="width:100px" min="0">
                                                    </div>
                                                </td>
                                                <td>
                                                    ₹{{!empty($cart->getProductData->sale_price) ? $cart->getProductData->sale_price : $cart->getProductData->price}}
                                                </td>

                                                <td class="text-right">
                                                    ₹{{!empty($cart->getProductData->sale_price) ? ($cart->getProductData->sale_price * $cart->quantity) : ($cart->getProductData->price * $cart->quantity)}}
                                                </td>
                                            </tr>                  
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                {{-- update cart button --}}
                                <div class="text-center mb-3">
                                    <span style="padding:12px; box-sizing:border-box" class="rounded bg-success">
                                    <input type="submit" class="btn btn-success my-1" value="Update-Cart" name="updatecart">&nbsp;<i class="fa fa-pencil" aria-hidden="true"></i> 
                                    </span>                   
                                    </form>
                                </div>
                                {{-- update cart button end--}}
                                <div class="cart-body">
                                    <div class="row">
                                        <div class="col-md-12 order-2 order-lg-1 col-lg-5 col-xl-6">
                                            <div class="order-note">
                                                <form action="{{route('cart.store')}}" method="post">
                                                    @csrf
                                                    {{-- this is coupon code sectin --}}
                                                    <div class="form-group">
                                                        {{-- <div class="input-group">
                                                            <input type="search" class="form-control"
                                                                   placeholder="Coupon Code" aria-label="Search"
                                                                   aria-describedby="button-addonTags">
                                                            <div class="input-group-append">
                                                                <button class="input-group-text" type="submit"
                                                                        id="button-addonTags">Apply
                                                                </button>
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="specialNotes">Special Note for this order:</label>
                                                        <textarea class="form-control" name="specialNotes"
                                                                  id="specialNotes" rows="3"
                                                                  placeholder="Message here">{{ auth()->user()->getComment->comment ?? "this is default message"}}</textarea>
                                                    </div>
                                                    <div class="text-center mt-3" style="height:50px;">
                                                        <span style="padding:10px; box-sizing:border-box" class="rounded bg-primary"><input type="submit" class="btn btn-primary my-1" value="Update-Comment" name="updatecomment">&nbsp;<i class="fa fa-pencil" aria-hidden="true"></i> 
                                                        </span>                   
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    
                                        <div class="col-md-12 order-1 order-lg-2 col-lg-7 col-xl-6">
                                            <div class="order-total table-responsive ">
                                                <table class="table table-borderless text-right">
                                                    <tbody>
                                                    <tr>
                                                        <td>Total Quantity :</td>
                                                        <td>{{$totalQuantity}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Price :</td>
                                                        <td>₹{{$totalPrice}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Shipping Charge :</td>
                                                        <td>₹{{$shippingCharge}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Including Tax(18%) :</td>
                                                        <td>₹{{$includingTax}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="f-w-7 font-18"><h4>Total Amount :</h4></td>
                                                        <td class="f-w-7 font-18"><h4>₹{{$amount}}</h4></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <div class="cart-footer text-right">
                                                    <a href="{{route('store_order')}}" class="btn btn-outline-success my-1"><i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                                                        &nbsp;Proceed to Checkout</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End col -->
    </div>
    <!-- End row -->
</div>
@include('store_locater')
@endsection