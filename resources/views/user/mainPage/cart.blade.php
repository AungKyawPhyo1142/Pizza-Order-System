@extends('user.layouts.master')

@section('content')

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <thead class="thead-dark">
                            <th>Product</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </thead>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cartList as $item)
                            <tr>
                                {{-- <input type="hidden" name="" id="price" value="{{$item->pizza_price}}"> --}}
                                <td><img src="{{asset('storage/'.$item->product_image)}}" alt="" class="img-thumbnail shadow-sm" style="width: 80px;"></td>
                                <td class="align-middle">
                                    {{$item->pizza_name}}
                                    <input type="hidden" name="" id="orderId" value="{{$item->id}}">
                                    <input type="hidden" name="" id="productId" value="{{$item->product_id}}">
                                    <input type="hidden" name="" id="userID" value="{{$item->user_id}}">
                                </td>
                                <td class="align-middle" id="price">{{$item->pizza_price}} Kyats</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus" >
                                            <i class="fa fa-minus"></i>
                                            </button>
                                        </div>

                                        <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" id="qty" value="{{$item->quantity}}">

                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle col-3" id="total">{{ $item->pizza_price * $item->quantity }} Kyats</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotalPrice">{{$totalPrice}} Kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">3000 Kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalPrice">{{$totalPrice + 3000}}</h5>
                        </div>
                        <button id="orderBtn" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                        <button id="clearBtn" class="btn btn-block btn-danger font-weight-bold my-3 py-3">Clear Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

@endsection

@section('scriptSource')
    <script src="{{asset('user/js/cart.js')}}"></script>
    <script>
        $(document).ready(function() {

            // order Btn
            $('#orderBtn').click(function(){

                $orderList = [];
                $random = Math.floor(Math.random()*10001);
                $('#dataTable tbody tr').each(function(index, row) {
                    $orderList.push({
                        'user_id' : $(row).find('#userID').val(),
                        'product_id' : $(row).find('#productId').val(),
                        'qty' : $(row).find('#qty').val(),
                        'total': Number($(row).find('#total').text().replace("Kyats","")),
                        'order_code': 'POS_'+$random+$(row).find('#userID').val()
                    });
                });

                // send data back to server using Ajax
                $.ajax({

                    type: "get",
                    url: "http://127.0.0.1:8000/user/ajax/order",
                    data: Object.assign({},$orderList) ,
                    dataType: "json",
                    success: function(response) {
                        if(response.status==true){
                            window.location.href = "http://127.0.0.1:8000/user/home";
                        }
                    }
                })


            })

            // clear Btn
            $('#clearBtn').click(function(){

                // delete data from db
                $.ajax({
                    type: "get",
                    url: "http://127.0.0.1:8000/user/ajax/clear/cart",
                    dataType: "json"
                })

                // clear for UI
                $('#dataTable tbody tr').remove();
                $('#subTotalPrice').html('0 Kyats');
                $('#finalPrice').html('3000 Kyats');

            })

            // for X (remove)
            $('.btnRemove').click(function() {

                $parentNode = $(this).parents("tr");
                $orderID = $parentNode.find('#orderId').val();
                $productID = $parentNode.find('#productId').val();

                // delete data from db
                $.ajax({
                    type: "get",
                    url: "http://127.0.0.1:8000/user/ajax/clear/currentProduct",
                    data: {'product_id' : $productID,'order_id':$orderID},
                    dataType: "json"
                })

                // clear the row from UI
                $parentNode.remove();
                finalCostCalculation();
            })

            // functions
            function finalCostCalculation() {
                $finalTotal = 0;
                $('#dataTable tbody tr').each(function(index, row) {
                    $finalTotal += Number($(row).find('#total').text().replace("Kyats", ""));
                })

                $('#subTotalPrice').html(`${$finalTotal} Kyats`)
                $('#finalPrice').html(`${$finalTotal+3000} Kyats`)
            }


        })
    </script>
@endsection
