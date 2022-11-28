@extends('Admin.layout_admin')
@section('main-content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Users</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('admin_dash')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Users</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                All Users
                <a href="{{route('admin_addUser')}}" class="btn btn-outline-primary btn-sm float-end"> + Add User</a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                    <tr>
                        <th>Full name</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>country</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @foreach ($users as $user)
                        <td>{{$user->FullName}}</td>
                        <td>{{$user->RoleName}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->contact}}</td>
                        <td>{{$user->getCountry->name}}</td>
                        <td style="max-width: 30px">
                            <a href="{{route('admin_showUsers',['id'=>$user->id])}}" class="btn btn-sm btn-warning">show</a>
                            <a href="{{route('admin_user_action',['id'=>$user->id,'status'=>$user->action==1?0:1])}}" class="btn btn-sm btn-{{$user->action==1?'danger':'success'}}">{{$user->action==1?'Deactive':'Active'}}</a>
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