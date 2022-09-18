@extends('admin.layouts.master')

@section('title','Add Food')

@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{route('product#showList')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Add Your Food or Drinks</h3>
                            </div>
                            <hr>
                            <form action="{{route('product#create')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Name</label>
                                    <input id="cc-pament" name="pizzaName" type="text"  class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                    @error('pizzaName')
                                        <small class="invalid-feedback">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Category</label>
                                    <select name="pizzaCategory" class="form-control" id="" class="category">
                                        <option value="">Select a food type</option>
                                        @foreach ($categories as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Description</label>
                                    <textarea name="pizzaDescription" id="" cols="20" rows="5" class="form-control"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Price</label>
                                    <input id="cc-pament" name="pizzaPrice" type="text"  class="form-control  @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                    @error('pizzaPrice')
                                        <small class="invalid-feedback">{{$message}}</small>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Product Image</label>
                                    <input type="file" name="pizzaImage" id="" class="form-control  @error('pizzaImage') is-invalid @enderror">
                                    @error('pizzaImage')
                                        <small class="invalid-feedback">{{$message}}</small>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Waiting Time (Min)</label>
                                    <input type="text" name="pizzaWaitingTime" id="" class="form-control  @error('pizzaWaitingTime') is-invalid @enderror">
                                    @error('pizzaWaitingTime')
                                        <small class="invalid-feedback">{{$message}}</small>
                                    @enderror

                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Create</span>
                                        <i class="fa-solid fa-circle-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
