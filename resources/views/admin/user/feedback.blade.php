@extends('admin.layouts.master')

@section('title','Customer Feedbacks')

@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Customer Feedbacks</h2>
                            </div>
                        </div>
                    </div>

                    <div class="row d-flex align-items-center justify-content-between">

                        <div class="col-3">
                            <i class="fa-solid fa-database me-1"></i>
                            <span>Total Data: </span>
                            <span>{{count($data)}}</span>
                        </div>

                    </div>

                        <div class="table-responsive table-responsive-data2">

                            @if (count($data)!=0)

                                <table class="table table-data2 text-center">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Feedbacks</th>
                                            <th>Send Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataList">

                                        @foreach ($data as $item)
                                        <tr class="tr-shadow">
                                            <input type="hidden" name="" class="orderId" value="{{$item->id}}">
                                            <td class="">{{$item->id}}</td>
                                            <td class="">{{$item->name}}</td>
                                            <td class="">{{$item->email}}</td>
                                            <td class="">{{Str::words($item->message,5,'...')}}</td>
                                            <td class="">{{$item->created_at->format('j-F-Y')}}</td>
                                            <td class="">
                                                <a href="{{route('admin#viewFeedbacks',$item->id)}}" class="btn btn-dark"><i class="fa-regular fa-eye"></i></a>
                                                <a href="{{route('admin#deleteFeedbacks',$item->id)}}" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                                            </td>
                                        </tr>

                                        <tr class="spacer"></tr>

                                        @endforeach


                                    </tbody>
                                </table>
                                <div>
                                    {{$data->links()}}
                                </div>

                            @else
                                <p style="font-size: 1.65rem" class=" text-secondary mt-5">
                                    There are no data at the moment. <br>
                                    Please check again after inserting some data.
                                </p>
                            @endif

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

                </div>
            </div>
        </div>
    </div>

@endsection

@section('scriptSection')
    <script>
    </script>
@endsection
