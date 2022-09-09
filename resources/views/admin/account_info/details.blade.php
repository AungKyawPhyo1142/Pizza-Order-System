@extends('admin.layouts.master')

@section('title','Account Profile')

@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Profile Info</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-3 offset-1 d-flex align-items-center">
                                    @if (Auth::user()->image == null)
                                        <img src="{{asset('image/default_profile.png')}}" class="shadow-sm" alt="Default User Profile Picture" />
                                    @else
                                    <img src="{{asset('storage/'.Auth::user()->image)}}" class="shadow-sm" alt="User Profile" />
                                    @endif
                                </div>
                                <div class="col-7 ms-5 d-flex flex-column align-items-center">
                                    <div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1 text-uppercase"><i class="fa-solid fa-user-check me-2"></i>Username: <span class="font-weight-bold">{{Auth::user()->name}}</span></label>
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1 text-uppercase"><i class="fa-solid fa-mars-and-venus me-2"></i>Gender: <span class="font-weight-bold">{{Auth::user()->gender}}</span></label>
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1"><i class="fa-solid fa-envelope me-2"></i>E-MAIL: <span class="font-weight-bold">{{Auth::user()->email}}</span></label>
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1 text-uppercase"><i class="fa-solid fa-phone me-2"></i>Phone: <span class="font-weight-bold">{{Auth::user()->phone}}</span></label>
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1 text-uppercase"><i class="fa-solid fa-location-dot me-2"></i>Address: <span class="font-weight-bold">{{Auth::user()->address}}</span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row d-flex">
                                <div class="col-6 d-flex align-items-center">
                                    <span class=" control-label"><i class="fa-solid fa-calendar-check me-2"></i>Joined Date: {{Auth::user()->created_at->format('j-F-Y')}}</span>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{route('admin#accountEditPage')}}" class="btn btn-dark text-white">
                                        <i class="fa-solid fa-pencil me-2"></i>
                                        Edit Profile
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
