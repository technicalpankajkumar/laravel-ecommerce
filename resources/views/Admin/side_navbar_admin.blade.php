<div id="layoutSidenav_nav" >
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background: rgb(2, 17, 94);border-top:1px dashed white;">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading text-success">Control Pannel</div>
                <a class="nav-link" href="{{route('admin_dash')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link" href="{{route('admin_profile')}}">
                    <div class="sb-nav-link-icon"><i class="fa fa-user-circle" aria-hidden="true"></i></div>
                    Admin Profile
                </a>
                <a class="nav-link" href="{{route('admin_userlist')}}">
                    <div class="sb-nav-link-icon"><i class="fa fa-users" aria-hidden="true"></i></div>
                    Users
                </a>
                <a class="nav-link" href="{{route('brand.index')}}">
                    <div class="sb-nav-link-icon"><i class="fa fa-list" aria-hidden="true"></i></div>
                    Brands
                </a>
                <a class="nav-link" href="{{route('product.index')}}">
                    <div class="sb-nav-link-icon"><i class="fa fa-archive" aria-hidden="true"></i></div>
                    Products
                </a>
                <a class="nav-link" href="{{route('admin_order_list')}}">
                    <div class="sb-nav-link-icon"><i class="fa fa-truck" aria-hidden="true"></i></div>
                    Orders
                </a>
                {{-- <a class="nav-link" href="index.html">
                    <div class="sb-nav-link-icon"><i class="fa fa-tag" aria-hidden="true"></i></div>
                    Discounts
                </a>
                <a class="nav-link" href="index.html">
                    <div class="sb-nav-link-icon"><i class="fa fa-credit-card" aria-hidden="true"></i></div>
                    Transactions
                </a> --}}
                <a class="nav-link" href="{{route('index')}}" target="__blank">
                    <div class="sb-nav-link-icon"><i class="fa fa-link" aria-hidden="true"></i></div>
                    Visit Site
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            ShopsStore Admin
        </div>
    </nav>
</div>
    