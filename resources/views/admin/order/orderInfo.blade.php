@extends('admin.layouts.master')

@section('title','Order Info')

@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Order List</h2>
                            </div>
                        </div>
                    </div>

                    <div class="row d-flex align-items-center justify-content-between">

                        <div class="col-3">
                            <a href="{{route('admin#orderList')}}" class="btn btn-dark"><i class="fa-solid fa-arrow-left-long me-1"></i>Back</a>
                        </div>

                        <div class="col-2 btn btn-secondary">
                            <i class="fa-solid fa-database me-1"></i>
                            <span>Total Data: </span>
                            <span> {{count($orderInfo)}} </span>
                        </div>

                    </div>

                        <div class="row col-6 mt-3">
                            <div class="card mt-3 border rounded">
                                <div class="card-body">
                                    <div class="row ">
                                        <h2 class="card-title"><i class="fa-solid fa-receipt me-2"></i>Order Info</h2>
                                    </div>
                                    <div class="row">
                                        <div class="col"><i class="fa-regular fa-user me-2"></i> Name</div>
                                        <div class="col">{{$orderInfo[0]->username}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col"><i class="fa-solid fa-barcode me-2"></i>Order-Code</div>
                                        <div class="col">{{$orderInfo[0]->order_code}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col"><i class="fa-regular fa-calendar me-2"></i> Order-Date</div>
                                        <div class="col">{{$orderInfo[0]->created_at->format('j-F-Y')}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col"><i class="fa-solid fa-coins me-2"></i> Total Cost</div>
                                        <div class="col">{{$order->total_price}} Kyats</div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <small class="">[ Delivery Fees is included in the total amount. ]</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-2 table-responsive table-responsive-data2">

                                <table class="table table-data2 text-center">
                                    <thead>
                                        <tr>
                                            <th>Product Image</th>
                                            <th>User ID</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataList">

                                        @foreach ($orderInfo as $item)

                                            <tr class="tr-shadow">
                                                <td class="col-2"><img src="{{asset('storage/'.$item->product_image)}}" class="img-thumbnail shadow-sm" alt=""></td>
                                                <td>{{$item->user_id}}</td>
                                                <td>{{$item->product_name}}</td>
                                                <td>{{$item->qty}}</td>
                                                <td>{{$item->total}} Kyats</td>
                                            </tr>

                                            <tr class="spacer"></tr>

                                        @endforeach


                                    </tbody>
                                </table>
                        </div>
                        <!-- END DATA TABLE -->

                </div>
            </div>
        </div>
    </div>

@endsection
