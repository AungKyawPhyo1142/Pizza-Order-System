@extends('admin.layouts.master')

@section('title','Order List')

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
                            <i class="fa-solid fa-database me-1"></i>
                            <span>Total Data: </span>
                            <span>{{count($order)}}</span>
                        </div>


                        <div class="col-3">
                            <form action="{{route('admin#sortStatus')}}" method="get">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <select name="status" id="" class="form-control status-change" aria-describedby="button-addon2">
                                            <option value="">All</option>
                                            <option value="0" @if(request('status')=='0') selected @endif>Pending</option>
                                            <option value="1" @if(request('status')=='1') selected @endif>Accept</option>
                                            <option value="2" @if(request('status')=='2') selected @endif>Reject</option>
                                        </select>
                                        <button class="btn btn-secondary" type="submit" id="button-addon2">Filter</button>
                                    </div>

                            </form>

                        </div>

                    </div>

                        <div class="table-responsive table-responsive-data2">

                            @if (count($order)!=0)

                                <table class="table table-data2 text-center">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Name</th>
                                            <th>Order Code</th>
                                            <th>Amount</th>
                                            <th>Order Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataList">

                                        @foreach ($order as $item)
                                        <tr class="tr-shadow">
                                            <input type="hidden" name="" class="orderId" value="{{$item->id}}">
                                            <td class="">{{$item->user_id}}</td>
                                            <td class="">{{$item->username}}</td>
                                            <td class="">
                                                <a href="{{route('admin#orderInfo',$item->order_code)}}">{{$item->order_code}}</a>
                                            </td>
                                            <td class="">{{$item->total_price}} Kyats</td>
                                            <td class="">{{$item->created_at->format('j-F-Y')}}</td>
                                            <td class="">
                                                <select name="status" id="" class="form-control status-change">
                                                    <option value="0" @if($item->status==0) selected @endif>Pending</option>
                                                    <option value="1" @if($item->status==1) selected @endif>Accept</option>
                                                    <option value="2" @if($item->status==2) selected @endif>Reject</option>
                                                </select>
                                            </td>
                                        </tr>

                                        <tr class="spacer"></tr>

                                        @endforeach


                                    </tbody>
                                </table>
                                <div>
                                    {{-- {{$order->links()}} --}}
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
        $(document).ready(function(){

            // if All btn is clicked
            $('#allBtn').click(function(){
                $status='';
                sendDataToSever($status);
            })
            // if Pending btn is clicked
            $('#pendingBtn').click(function(){
                $status=0;
                sendDataToSever($status);
            })
            // if Accept btn is clicked
            $('#acceptBtn').click(function(){
                $status=1;
                sendDataToSever($status);
            })
            // if Reject btn is clicked
            $('#rejectBtn').click(function(){
                $status=2;
                sendDataToSever($status);
            })

            function sendDataToSever($status){
                $.ajax({
                    type:'get',
                    url: 'http://127.0.0.1:8000/order/ajax/status',
                    data:{'status':$status},
                    dataType: 'json',
                    success: function(response){

                        // append data into table
                        $list = '';
                        $month = ["January","February","March","April","May","June","July","August","September","October","November","December"];
                        for ($i = 0; $i < response.length; $i++) {

                            $dbDate = new Date(response[$i].created_at);
                            $date = $month[$dbDate.getMonth()]+'-'+$dbDate.getDate()+'-'+$dbDate.getFullYear();

                            if(response[$i].status==0){
                                $statusMessage = `
                                    <select name="status" id="" class="form-control status-change">
                                        <option value="0" selected>Pending</option>
                                        <option value="1">Accept</option>
                                        <option value="2">Reject</option>
                                    </select>
                                `;
                            }
                            else if(response[$i].status==1){
                                $statusMessage = `
                                    <select name="status" id="" class="form-control status-change">
                                        <option value="0">Pending</option>
                                        <option value="1" selected>Accept</option>
                                        <option value="2">Reject</option>
                                    </select>
                                `;
                            }
                            else{
                                $statusMessage = `
                                    <select name="status" id="" class="form-control status-change">
                                        <option value="0">Pending</option>
                                        <option value="1">Accept</option>
                                        <option value="2" selected>Reject</option>
                                    </select>
                                `;
                            }

                            $list += `
                                        <tr class="tr-shadow">
                                            <input type="text" name="" class="orderId" value="${response[$i].id}"">
                                            <td class="">${response[$i].user_id}</td>
                                            <td class="">${response[$i].username}</td>
                                            <td class="">${response[$i].order_code}</td>
                                            <td class="">${response[$i].total_price} Kyats</td>
                                            <td class="">${$date}</td>
                                            <td class="">
                                                ${$statusMessage}
                                            </td>
                                        </tr>

                                        <tr class="spacer"></tr>
                            `;
                        }
                        $('#dataList').html($list);

                    }
                });
            }

            // change status
            $('.status-change').change(function(){
                $currentStatus = $(this).val();
                $parentNode = $(this).parents("tr");
                $orderId = $parentNode.find('.orderId').val();

                $data = {
                    'status' : $currentStatus,
                    'order_id' : $orderId
                };

                $.ajax({
                    type:'get',
                    url: 'http://127.0.0.1:8000/order/ajax/change/status',
                    data: $data,
                    dataType: 'json'
                });

            });

        });
    </script>
@endsection
