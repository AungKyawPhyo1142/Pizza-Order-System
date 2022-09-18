@extends('admin.layouts.master')

@section('title','Feedback Details')

@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Feedback Details</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-5">
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1 text-uppercase"><i class="fa-solid fa-user-check me-2"></i>Username: <span class="font-weight-bold">{{$data->name}}</span></label>
                                    </div>

                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1"><i class="fa-solid fa-envelope me-2"></i>E-MAIL: <span class="font-weight-bold">{{$data->email}}</span></label>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <textarea class="form-control" disabled name="" id="" cols="30" rows="5">{{$data->message}}</textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row d-flex">
                                <div class="col-6 d-flex align-items-center">
                                    <span class=" control-label"><i class="fa-solid fa-calendar-check me-2"></i>Joined Date: {{$data->created_at->format('j-F-Y')}}</span>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{route('admin#feedbacks')}}" class="btn btn-dark text-white">
                                        <i class="fa-solid fa-chevron-left me-2"></i>
                                        Back
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
