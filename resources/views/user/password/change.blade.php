@extends('user.layouts.master');

@section('content')

    <div class="row">
        <div class="col-6 offset-3">
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Change Password Form</h3>
                                    </div>
                                    <hr>
                                    <form action="{{route('user#changePassword')}}" method="post" novalidate="novalidate">
                                        @csrf
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                            <input id="cc-pament" name="oldPassword" type="password" class="form-control @if(session('notMatch')) is-invalid @endif @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Old Password...">
                                            @error('oldPassword')
                                                <small class="invalid-feedback">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">New Password</label>
                                            <input id="cc-pament" name="newPassword" type="password" class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="New Password...">
                                            @error('newPassword')
                                                <small class="invalid-feedback">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                            <input id="cc-pament" name="confirmPassword" type="password" class="form-control @error('confirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Confirm Password...">
                                            @error('confirmPassword')
                                                <small class="invalid-feedback">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div>
                                            <button id="payment-button" type="submit" class="btn btn-lg btn-dark btn-block">
                                                <i class="fa-solid fa-arrows-rotate me-1"></i>
                                                <span id="payment-button-amount">Change Password</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
