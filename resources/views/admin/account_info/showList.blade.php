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
                        <div class="table-data__tool-right">
                            <a href="{{route('category#createPage')}}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add Category
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
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
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($admin as $item)

                                    <tr class="tr-shadow">
                                        <td class="col-2">
                                            @if ($item->image==null)
                                                <img src="{{asset('image/default_profile.png')}}" class="img-thumbnail shadow-sm" alt="">

                                            @else
                                                <img src="{{asset('storage/'.$item->image)}}" class="img-thumbnail shadow-sm" alt="">
                                            @endif
                                        </td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->gender}}</td>
                                        <td>{{$item->phone}}</td>
                                        <td>{{$item->address}}</td>
                                        <td class="col-2">
                                            <div class="table-data-feature">
                                                @if (Auth::user()->id != $item->id)
                                                    <a href="{{route('admin#delete',$item->id)}}">
                                                        <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{route('admin#changeRole',$item->id)}}">
                                                        <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Role Change">
                                                            <i class="fa-solid fa-person-circle-exclamation me-2"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>

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
