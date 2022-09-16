@extends('user.layouts.master');

@section('content')

    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by categories</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <label class="" for="price-all">Categories</label>
                            <span class="badge border text-dark font-weight-normal">{{count($category)}}</span>
                        </div>
                        <hr>

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="{{route('user#home')}}" class="text-dark"><label class="" for="price-1">All</label></a>
                        </div>
                        @foreach ($category as $c)
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="{{route('user#filter',$c->id)}}" class="text-dark"><label class="" for="price-1">{{$c->name}}</label></a>
                            </div>
                        @endforeach

                    </form>
                </div>
                <!-- Price End -->

                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <a href="{{route('user#cartList')}}">
                                    <button type="button" class="btn btn-dark text-white border rounded position-relative">
                                        <i class="fa-solid fa-cart-shopping me-1"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{count($cart)}}
                                        </span>
                                    </button>
                                </a>
                                <a href="{{route('user#history')}}" class="ms-3">
                                    <button type="button" class="btn btn-dark text-white border rounded position-relative">
                                        <i class="fa-solid fa-clock-rotate-left me-1"></i>
                                        History
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{count($history)}}
                                        </span>
                                    </button>
                                </a>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <select name="sorting" class="form-control" id="sortingOptions">
                                        <option value="">Sorting Options...</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>
                                <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">10</a>
                                        <a class="dropdown-item" href="#">20</a>
                                        <a class="dropdown-item" href="#">30</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="dataList">

                        @if (count($pizza)!=0)
                            @foreach ($pizza as $item)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1" id="">
                                    <div class="product-item bg-light mb-4" id="myForm">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" style="height: 210px" src="{{asset('storage/'.$item->image)}}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href="{{route('user#pizzaDetails',$item->id)}}"><i class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">{{$item->name}}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{$item->price}} Kyats</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        @else
                            <p class="text-center shadow-sm fs-1 col-6 offset-3 py-5">There is no pizza <i class="fa-solid fa-pizza-slice ms-3"></i></p>
                        @endif

                    </div>

                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->


@endsection

@section('scriptSource')

<script>
$(document).ready(function() {

$('#sortingOptions').change(function() {
    $eventOption = $('#sortingOptions').val(); // get the value

    if ($eventOption == 'asc') {

        $.ajax({
            type: "get",
            url: "http://127.0.0.1:8000/user/ajax/pizzaList",
            data: { 'status': 'asc' },
            dataType: "json",
            success: function(response) {
                $list = '';
                for ($i = 0; $i < response.length; $i++) {

                    $list += `
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1" id="">
                        <div class="product-item bg-light mb-4" id="myForm">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" style="height: 210px" src="{{asset('storage/${response[$i].image}')}}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>${response[$i].price} Kyats</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;

                }

                $('#dataList').html($list);

            }
        })

    } else if ($eventOption == 'desc') {

        $.ajax({
            type: "get",
            url: "http://127.0.0.1:8000/user/ajax/pizzaList",
            data: { 'status': 'desc' },
            dataType: "json",
            success: function(response) {
                $list = '';
                for ($i = 0; $i < response.length; $i++) {

                    $list += `
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1" id="">
                        <div class="product-item bg-light mb-4" id="myForm">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" style="height: 210px" src="{{asset('storage/${response[$i].image}')}}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>${response[$i].price} Kyats</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;

                }

                $('#dataList').html($list);


            }
        })

    }

})

});
</script>

@endsection
