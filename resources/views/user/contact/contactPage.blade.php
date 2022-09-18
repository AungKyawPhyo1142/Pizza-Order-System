@extends('user.layouts.master');

@section('content')

    <div class="row p-5 align-items-center">
        <div class="row">
            {{-- contact info --}}
            <div class="col-5">
                <div class="card bg-dark">
                    <div class="card-body">
                        <h2 class="card-title text-white">
                            <i class="fa-regular fa-paper-plane me-3"></i>Send us your feedback
                        </h2>
                        <hr class="spacer text-white">
                        <div class="card-text text-white">
                            <span class="fs-4 fw-light"><i class="fa-regular fa-envelope me-4"></i>Email : admin@gmail.com</span>
                        </div>
                        <div class="card-text text-white mt-4">
                            <span class="fs-4 fw-light"><i class="fa-solid fa-mobile-screen me-4"></i>Phone : +959769477990</span>
                        </div>
                        <div class="card-text text-white mt-4">
                            <span class="fs-4 fw-light"><i class="fa-solid fa-map-location-dot me-3"></i>Address : 26th & 22nd Street, Mandalay.</span>
                        </div>
                        <div class="card-text text-white mt-4">
                            <span class="fs-4 fw-light"><i class="fa-regular fa-clock me-3"></i>Office Hour : 9:00AM ~ 5:00PM</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card bg-warning">
                    <div class="card-body">
                        <h2 class="card-title text-dark">
                            Feedback:
                        </h2>
                        <form action="{{route('user#feedback')}}" class="mb-0" method="POST">
                            @csrf
                            <div class="card-text">
                                <textarea class="form-control" name="feedback" id="" cols="30" rows="7" placeholder="Enter your feedback"></textarea>
                            </div>
                            <div class="mt-3 d-flex justify-content-between">
                                <button type="submit" class="btn btn-dark border rounded me-4"><i class="fa-regular fa-paper-plane me-2"></i>SEND</button>
                                <a href="{{route('user#home')}}" class="btn btn-secondary border rounded"><i class="fa-solid fa-chevron-left me-2"></i>Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>

        @if (session('sendSuccess'))
                <div class="mt-3 col-4 alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('sendSuccess')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        @endif

    </div>


@endsection
