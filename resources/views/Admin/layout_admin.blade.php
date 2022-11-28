<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Dashboard-ShopsStore Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet"/>
    <link href="{{asset('admin_Assets/css/styles.css')}}" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
            crossorigin="anonymous"></script>
            
</head>
<body class="sb-nav-fixed">
    @include('Admin.navbar_admin')
    <div id="layoutSidenav">
        @include('Admin.side_navbar_admin')
        <div id="layoutSidenav_content">
            @yield('main-content')
            @include('Admin.footer_admin')
        </div>
    </div>
@include('Admin.footer_script')
</body>
</html>