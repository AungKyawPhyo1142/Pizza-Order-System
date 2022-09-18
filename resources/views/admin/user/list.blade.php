@extends('admin.layouts.master')

@section('title','User List')

@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">User List</h2>
                            </div>
                        </div>
                    </div>

                    <div class="row d-flex align-items-center justify-content-between">

                        <div class="col-3">
                            <i class="fa-solid fa-database me-1"></i>
                            <span>Total Data: </span>
                            <span>{{count($users)}}</span>
                        </div>

                    </div>

                        <div class="table-responsive table-responsive-data2">

                                <table class="table table-data2 text-center">
                                    <thead>
                                        <tr>
                                            <th>Profile Image</th>
                                            <th>Admin Name</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Role</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataList">

                                        @foreach ($users as $item)

                                        <tr class="tr-shadow">
                                            <input type="hidden" name="" id="userId" value="{{$item->id}}">
                                            <td class="col-2">
                                                @if ($item->image==null)
                                                    <img src="{{asset('image/default_profile.png')}}" class="img-thumbnail shadow-sm" alt="">

                                                @else
                                                    <img src="{{asset('storage/'.$item->image)}}" class="img-thumbnail shadow-sm" alt="">
                                                @endif
                                            </td>
                                            <td class="">{{$item->name}}</td>
                                            <td class="">{{$item->email}}</td>
                                            <td class="">{{$item->gender}}</td>
                                            <td class="">{{$item->phone}}</td>
                                            <td class="">{{$item->address}}</td>


                                                    <td class="">
                                                        <select name="" id="" class="form-control role-change">
                                                            <option value="admin">Admin</option>
                                                            <option value="user" selected>User</option>
                                                        </select>
                                                    </td>

                                                    <td class="">
                                                        <a href="">
                                                            <i class="fa-regular fa-trash-can fs-4 text-dark"></i>
                                                        </a>
                                                    </td>

                                        </tr>

                                        <tr class="spacer"></tr>

                                        @endforeach

                                    </tbody>
                                </table>
                            <div>
                                {{$users->links()}}
                            </div>
                        </div>
                        <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scriptSection')
    <script>
            $(document).ready(function(){
                $('.role-change').change(function(){
                    $role = $(this).val();
                    $parentNode = $(this).parents("tr");
                    $userId = $parentNode.find('#userId').val();

                    $.ajax({
                            type:'get',
                            url: 'http://127.0.0.1:8000/user/change/role',
                            data: {
                                'role':$role,
                                'user_id':$userId },
                            dataType: 'json',
                    });

                    location.reload();

                })
            });

    </script>
@endsection
