@extends('user.layouts.master');

@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container">
                <div class="col-lg">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Edit Account Info</h3>
                            </div>

                            <hr>

                            @if (session('updateSuccess'))
                                <div class="mt-3 col-5 alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{session('updateSuccess')}}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif


                            <form action="{{route('user#accountChange',Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row d-flex">
                                    <div class="col-6 align-self-center">
                                        <div class="img-container">
                                            @if (Auth::user()->image == null)
                                                <img src="{{asset('image/default_profile.png')}}" class="shadow-sm img-thumbnail" alt="Default User Profile Picture" />
                                            @else
                                                <img src="{{asset('storage/'.Auth::user()->image)}}" class="shadow-sm img-thumbnail" alt="User Profile" />
                                            @endif

                                            <input class="mt-4 @error('image') is-invalid @enderror" type="file" name="image" id="">
                                            @error('image')
                                                <small class="invalid-feedback">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col border-start border-dark">

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name:</label>
                                            <input id="cc-pament" name="name" type="text" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{Auth::user()->name}}">
                                            @error('name')
                                                <small class="invalid-feedback">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Role:</label>
                                            <input id="cc-pament" name="role" type="text" disabled class="form-control @error('role') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{Auth::user()->role}}">
                                            @error('role')
                                                <small class="invalid-feedback">{{$message}}</small>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Phone:</label>
                                            <input id="cc-pament" name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{Auth::user()->phone}}">
                                            @error('phone')
                                            <small class="invalid-feedback">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Gender:</label>
                                            <select name="gender" class="form-control">
                                                <option value="male" @if(Auth::user()->gender == 'male') selected @endif>Male</option>
                                                <option value="female" @if(Auth::user()->gender == 'female') selected @endif>Female</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Address:</label>
                                            <input id="cc-pament" name="address" type="text" class="form-control @error('address') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{Auth::user()->address}}">
                                            @error('address')
                                                <small class="invalid-feedback">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Email:</label>
                                            <input id="cc-pament" name="email" type="text" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{Auth::user()->email}}">
                                            @error('email')
                                                <small class="invalid-feedback">{{$message}}</small>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <hr>
                                <div class="row d-flex justify-content-between">
                                    <div class="col-3">
                                        <a href="{{route('admin#accountDetails')}}"  class="btn btn-dark text-white"><i class="fa-solid fa-angle-left me-2"></i>Back</a>
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
