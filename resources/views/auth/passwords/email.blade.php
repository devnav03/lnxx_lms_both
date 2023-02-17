@extends('layouts.login')

@section('content')
<div class="row row-sm">
    <div class="col-lg-6 col-xl-5 d-none d-lg-block text-center bg-primary details">
        <div class="mt-3 pt-3 p-2 pos-absolute">
            <img src="{{ asset(config('app.images.logo_small_url'))}}" class="header-brand-img mb-4" alt="logo">
            <div class="clearfix"></div>
            <img src="{{ asset('img/svgs/user.svg') }}" class="ht-100 mb-0" alt="user">
            <h5 class="mt-4 text-white">Reset Your Password</h5>
            <span class="tx-white-6 tx-13 mb-5 mt-xl-0">Signup to create, discover and connect with the global community</span>
        </div>
    </div>
    <div class="col-lg-6 col-xl-7 col-xs-12 col-sm-12 login_form ">
        <div class="main-container container-fluid">
            <div class="row row-sm">
                <div class="card-body mt-2 mb-2">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="clearfix"></div>
                    <h5 class="text-start mb-2">Forgot Password</h5>
                    <p class="mb-4 text-muted tx-13 ms-0 text-start">It's free to signup and only takes a minute.</p>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group text-start">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn ripple btn-main-primary btn-block">Request reset link</button>
                    </form>
                    <div class="card-footer border-top-0 ps-0 mt-3 text-start ">
                        <p>Did you remembered your password?</p>
                        <p class="mb-0">Try to <a href="{{ route('login') }}">Signin</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
