@extends('user.layouts.master')

@section('content')

    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{asset('storage/'.$pizza->image)}}" alt="Image">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{$pizza->name}}</h3>
                    <div class="d-flex mb-3">
                        {{-- <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div> --}}
                        <small class="pt-1"><i class="fa-solid fa-eye me-1"></i> {{$pizza->view_count}} </small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{$pizza->price}} Kyats</h3>
                    <p class="mb-4">{{$pizza->description}}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary border-0 text-center" value="1" id="orderCount">
                            <input type="hidden" name="" id="userID" value="{{Auth::user()->id}}">
                            <input type="hidden" name="" id="pizzaID" value="{{$pizza->id}}">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary px-3" id="addCartBtn"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>

                        <a href="{{route('user#home')}}" class="btn btn-dark ms-2">Back</a>

                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function(){
            $('#addCartBtn').click(function(){

                $source = {
                    'count' : $('#orderCount').val(),
                    'userID' : $('#userID').val(),
                    'pizzaID' : $('#pizzaID').val()
                };

                $.ajax({
                    type: "get",
                    url: "http://127.0.0.1:8000/user/ajax/addToCart",
                    data: $source ,
                    dataType: "json",
                    success: function (response) {
                        if(response.status == 'success'){
                            window.location.href = "http://127.0.0.1:8000/user/home";
                        }
                    }
                })

            })
        })
    </script>
@endsection
