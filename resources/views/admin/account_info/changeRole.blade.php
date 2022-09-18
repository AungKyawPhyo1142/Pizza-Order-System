@extends('admin.layouts.master')

@section('title','Change Account Role')

@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Change Account Role</h3>
                            </div>
                            <hr>
                            <form action="{{route('admin#change',$account->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row d-flex">
                                    <div class="col-6 align-self-center">
                                        <div class="img-container">
                                            @if ($account->image == null)
                                                <img src="{{asset('image/default_profile.png')}}" class="shadow-sm" alt="Default User Profile Picture" />
                                            @else
                                                <img src="{{asset('storage/'.$account->image)}}" class="shadow-sm" alt="User Profile" />
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col border-start border-dark">

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name:</label>
                                            <input id="cc-pament" disabled name="name" type="text" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{$account->name}}">
                                            @error('name')
                                                <small class="invalid-feedback">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Role:</label>
                                            <select name="role" class="form-control" id="">
                                                <option value="admin @if($account->role == 'admin') selected @endif">Admin</option>
                                                <option value="user @if($account->role == 'user') selected @endif">User</option>
                                            </select>
                                            @error('role')
                                                <small class="invalid-feedback">{{$message}}</small>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Phone:</label>
                                            <input id="cc-pament" disabled name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{$account->phone}}">
                                            @error('phone')
                                            <small class="invalid-feedback">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Gender:</label>
                                            <select name="gender" disabled class="form-control">
                                                <option value="male" @if($account->gender == 'male') selected @endif>Male</option>
                                                <option value="female" @if($account->gender == 'female') selected @endif>Female</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Address:</label>
                                            <input id="cc-pament" disabled name="address" type="text" class="form-control @error('address') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{$account->address}}">
                                            @error('address')
                                                <small class="invalid-feedback">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Email:</label>
                                            <input id="cc-pament" disabled name="email" type="text" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{$account->email}}">
                                            @error('email')
                                                <small class="invalid-feedback">{{$message}}</small>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <hr>
                                <div class="row d-flex justify-content-between">
                                    <div class="col-3">
                                        <a href="{{route('admin#showAdminList')}}"  class="btn btn-dark text-white"><i class="fa-solid fa-angle-left me-2"></i>Back</a>
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
