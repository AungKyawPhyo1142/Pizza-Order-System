@extends('admin.layouts.master')

@section('title','Pizza Edit Page')

@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Edit Pizza Info</h3>
                            </div>
                            <hr>
                            <form action="{{route('product#edit')}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row d-flex">
                                    <div class="col-6 align-self-center">
                                        <input type="hidden" name="pizzaID" value="{{$pizza->id}}">
                                        <div class="img-container">
                                                <img src="{{ asset('storage/'.$pizza->image) }}" class="shadow-sm" alt="Pizza Image" />

                                            <input class="mt-4 @error('pizzaImage') is-invalid @enderror" type="file" name="pizzaImage" id="">
                                            @error('pizzaImage')
                                                <small class="invalid-feedback">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col border-start border-dark">

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name:</label>
                                            <input id="cc-pament" name="pizzaName" type="text" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{$pizza->name}}">
                                            @error('pizzaName')
                                                <small class="invalid-feedback">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Price:</label>
                                            <input id="cc-pament" name="pizzaPrice" type="text" class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{$pizza->price}}">
                                            @error('pizzaPrice')
                                            <small class="invalid-feedback">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Category:</label>
                                            <select name="pizzaCategory" class="form-control" id="">

                                                @foreach ($categories as $item)
                                                    <option value="{{$item->id}}" @if($pizza->category_id == $item->id) selected @endif>{{$item->name}}</option>
                                                @endforeach

                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Description:</label>
                                            <textarea name="pizzaDescription" id="" cols="30" rows="10" class="form-control @error('pizzaDescription') is-invalid @enderror">{{$pizza->description}}</textarea>
                                            @error('pizzaDescription')
                                                <small class="invalid-feedback">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Waiting Time (Min):</label>
                                            <input type="text" name="pizzaWaitingTime" value="{{$pizza->waiting_time}}" class="form-control @error('pizzaWaitingTime') is-invalid @enderror">
                                            @error('pizzaWaitingTime')
                                                <small class="invalid-feedback">{{$message}}</small>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <hr>
                                <div class="row d-flex justify-content-between">
                                    <div class="col-3">
                                        <a href="{{route('product#details',$pizza->id)}}"  class="btn btn-dark text-white"><i class="fa-solid fa-angle-left me-2"></i>Back</a>
                                    </div>
                                    <div class="col-3 text-end">
                                        <button type="submit" class="btn btn-dark text-white"><i class="fa-solid fa-arrows-rotate me-2"></i>Update Info</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
