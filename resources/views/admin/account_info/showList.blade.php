@extends('admin.layouts.master')

@section('title','Admin List')

@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Admin List</h2>
                            </div>
                        </div>
                        <div class="table-data__tool-center d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-database me-2"></i>
                            <span> {{$admin->total()}} </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3 offset-9">

                            <form action="{{route('admin#showAdminList')}}" method="GET">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="text" name="searchKey" class="form-control" value="{{old('searchKey')}}" placeholder="Search..." aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <button class="btn btn-secondary" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>

                    </div>

                    @if (count($admin)!=0)
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
                                <tbody>

                                    @foreach ($admin as $item)

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
                                        {{-- <td class="col-2"> --}}

                                            @if (Auth::user()->id != $item->id)

                                                <td class="">
                                                    <select name="" id="" class="form-control role-change">
                                                        <option value="admin" selected>Admin</option>
                                                        <option value="user">User</option>
                                                    </select>
                                                </td>

                                                <td class="">
                                                    <a href="{{route('admin#delete',$item->id)}}">
                                                        <i class="fa-regular fa-trash-can fs-4 text-dark"></i>
                                                    </a>
                                                </td>

                                            @else
                                                <td></td>
                                                <td></td>
                                            @endif
                                    </tr>

                                    <tr class="spacer"></tr>

                                    @endforeach

                                </tbody>
                            </table>
                            <div class="">
                                {{-- {{$admin->links()}} --}}
                            </div>
                        </div>
                        <!-- END DATA TABLE -->

                        @if (session('deleteSuccess'))
                            <div class="mt-3 col-5 alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{session('deleteSuccess')}}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif


                    @else
                        <p style="font-size: 1.65rem" class=" text-secondary mt-5">
                            There are no data at the moment. <br>
                            Please check again after inserting some data.
                        </p>

                    @endif

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
                    url: 'http://127.0.0.1:8000/admin/ajax/changeRole',
                    data: {
                        'role':$role,
                        'user_id':$userId },
                    dataType: 'json',
                    success:function(response){
                        window.location.reload(true);
                    }
            });


        })
    });
</script>

@endsection
