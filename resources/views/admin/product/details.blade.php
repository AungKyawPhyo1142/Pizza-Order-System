@extends('admin.layouts.master')

@section('title','Product Details')

@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Product Info</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-3 offset-1 d-flex align-items-center">
                                    <img src="{{asset('storage/'.$pizza->image)}}" class="shadow-sm" alt="Pizza Photo" />
                                </div>
                                <div class="col-7 ms-5 d-flex flex-column align-items-center">
                                    <div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1 text-uppercase bg-danger px-5 py-1"><span class="fs-5 font-weight-bold text-white">{{$pizza->name}}</span></label>
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1 text-uppercase"><i class="fa-solid fa-dollar-sign me-2"></i> <span class="font-weight-bold">{{$pizza->price}} Kyats</span></label>
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1 text-uppercase"><i class="fa-solid fa-clock me-2"></i>Waiting Time: <span class="font-weight-bold">{{$pizza->waiting_time}} min</span></label>
                                        </div>

                                        <div class="form-group">
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1 text-uppercase"><i class="fa-solid fa-file-lines me-2"></i>Description:</label>
                                            <p class="mt-1">
                                                {{$pizza->description}}
                                            </p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row d-flex">
                                <div class="col-6 d-flex align-items-center">
                                    <span class=" control-label"><i class="fa-solid fa-calendar-check me-2"></i>Created Date: {{$pizza->created_at->format('j-F-Y')}}</span>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{route('product#editPage',$pizza->id)}}" class="btn btn-dark text-white">
                                        <i class="fa-solid fa-pencil me-2"></i>
                                        Edit Pizza
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(session('updateSuccess'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{session('updateSuccess')}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
