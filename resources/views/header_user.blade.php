<nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('index')}}">ShopsStore</a>
        <!-- Links -->
        <ul class="navbar-nav">
            <li>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="{{route('cart.index')}}" class="nav-link" style="margin-right: 18px">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    Cart</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle btn" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="margin-right: 18px">
                    @auth {{auth()->user()->first_name." ".auth()->user()->last_name}} @endauth @guest Guest User @endguest
                </a>
                @auth
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{route('profileUser')}}">My Profile</a></li>
                    @if(auth()->user()->role_id==1)
                    <li><a class="dropdown-item" href="{{route('admin_dash')}}">Dashboard</a></li>
                    @endif
                    <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
                    <li><a class="dropdown-item" href="{{{route('forgetPassword')}}}">Change Password</a></li>
                </ul>
                @endauth 
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{route('login')}}">Login</a></li>
                    <li><a class="dropdown-item" href="{{{route('forgetPassword')}}}">Change Password</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>