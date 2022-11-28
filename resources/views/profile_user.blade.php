@extends('layout_user')
@section('main-containt')
<!-- Header-->

{{-- {{dd($user)}}
{{die;}} --}}
<div class="container h-100" style="margin: 7% 0% 7% 17%;">
    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header"><h5>Profile Picture</h5></div>
                    <div class="card-body">
                        <div class="row mb-3">
                        <!-- Profile picture image-->
                        <img class="img-account-profile rounded-circle " style="background-attachment: fixed;backgroun-size:cover; height:250px; width:300px; margin:auto;" src="{{url('uploads').'/'.$img=$user->profile}}" alt="Profile Image" />
                        <form method="POST" action="{{route('imageUserUpdate')}}" enctype="multipart/form-data">
                            @csrf
                                <div class="col">
                                    <input type="file" class="form-control-file" name="profile" id="profile">
                                </div>                           
                            <br>
                            <div class="col">
                                <input type="submit" name="updateImg" id="updateImg" value="Update Image"
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
                    <div class="card-header"><h5>Account Details</h5></div>
                    <div class="card-body">
                        <form method="POST" action="{{route('profileUserUpdate')}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                           value="{{$user->first_name}}"
                                           required="">
                                </div>
                                <div class="col">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                          value="{{$user->last_name}}"
                                           required="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                    value="{{$user->email}}" disabled>
                                </div>
                                <div class="col">
                                    <label for="contact" class="form-label">Contact Number</label>
                                    <input type="tel" class="form-control" id="contact" name="contact"
                                    value="{{$user->contact}}"required="">
                                </div>
                            </div>
                            <div class="row mb-3">              
                                <div class="col-6">
                                    <label for="gender" class="form-label">Gender</label><br>
                                    <input type="radio" id="gender" name="gender" value="Male" @if($user->gender=='Male') checked @endif>&nbsp;&nbsp;Male&nbsp;&nbsp;
                                    <input type="radio" id="gender" name="gender" value="Female" @if($user->gender=='Female') checked @endif>&nbsp;&nbsp;Female
                                </div>
                                <div class="col-6">
                                <label for="inputCountry" class="form-label">Country</label>
                                <select class="form-select" id="inputCountry"
                                        aria-label="Default select example" name="country"
                                        required="">
                                    <option selected disabled>Select</option>
                                    @foreach ($country as $countries)
                                    <option value="{{$countries->id}}" @if ($user->country==$countries->id) selected @endif>{{$countries->name}}</option>
                                    @endforeach                                    
                                </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" id="address" rows="3" name="address"
                                              placeholder="address" required="">{{$user->address}}</textarea>
                                </div>
                            </div>
                            <br>
                            <div class="mb-3">
                                <input type="submit" name="update" id="update" value="Update Profile"
                                       class="btn btn-outline-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Orders Section -->
        <div class="row">
            <div class="col-xl">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header"><h5>My Orders</h5></div>
                    <div class="card-body text-center">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">SN</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total_Amounts</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($lineItemsData as $lineItems)
                            <tr>
                                <td scope="row">{{$loop->iteration}}</td>
                                <td>{{$lineItems->getProductData->name}}</td>
                                <td>{{$lineItems->created_at}}</td>
                                <td>₹{{$lineItems->price}}</td>
                                <td>{{$lineItems->quantity}}</td>
                                <td>{{$lineItems->getOrderData->total_amount}}</td>
                                <td>{{$lineItems->getOrderData->status}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection