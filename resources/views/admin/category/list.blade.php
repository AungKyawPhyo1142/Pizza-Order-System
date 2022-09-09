@extends('admin.layouts.master')

@section('title','Category List')

@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Category List</h2>
                            </div>
                        </div>
                        <div class="table-data__tool-center d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-database me-2"></i>
                            <span>{{count($categories)}}</span>
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

                            <form action="{{route('category#list')}}" method="GET">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="text" name="searchKey" class="form-control" value="{{old('searchKey')}}" placeholder="Search..." aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <button class="btn btn-secondary" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>

                    </div>

                    @if (count($categories)!=0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>Created Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($categories as $item)
                                    <tr class="tr-shadow">
                                        <td>
                                            {{$item->id}}
                                        </td>
                                        <td class="col-5">{{$item->name}}</td>
                                        <td>{{$item->created_at->format('j-F-Y')}}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button> --}}
                                                <a href="{{route('category#editPage',$item->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>
                                                <a href="{{route('category#delete',$item->id)}}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="spacer"></tr>

                                    @endforeach

                                </tbody>
                            </table>
                            <div class="">
                                {{$categories->links()}}
                            </div>
                        </div>
                        <!-- END DATA TABLE -->

                        @if (session('deleteSuccess'))
                            <div class="mt-3 col-4 alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{session('deleteSuccess')}}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('createSuccess'))
                            <div class="mt-3 col-4 alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{session('createSuccess')}}</strong>
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
