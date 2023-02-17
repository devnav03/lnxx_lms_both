@extends('admin.layouts.login')

@section('content')
<div class="row row-sm">
    <div class="col-lg-6 col-xl-5 d-none d-lg-block text-center bg-primary details">
        <div class="mt-5 pt-4 p-2 pos-absolute">
        <img src="{{ asset(config('app.images.logo_small_url'))}}" class="header-brand-img mb-4" alt="logo">
            <div class="clearfix"></div>
            <div class="clearfix"></div>
            <img src="{{ asset('img/svgs/user.svg') }}" class="ht-100 mb-0" alt="user">
            <h5 class="mt-4 text-white">Create Your Account</h5>
            <span class="tx-white-6 tx-13 mb-5 mt-xl-0">Signup to create, discover and connect with the global community</span>
        </div>
    </div>
    <div class="col-lg-6 col-xl-7 col-xs-12 col-sm-12 login_form ">
        <div class="main-container container-fluid">
            <div class="row row-sm">
                <div class="card-body mt-2 mb-2">
                    <div class="clearfix"></div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <h5 class="text-start mb-2 mb-4">Signin to Your Account</h5>
                        <!-- <p class="mb-4 text-muted tx-13 ms-0 text-start">Signin to create , discover and connect with the global community</p> -->
                        <div class="form-group text-start">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group text-start">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group text-start">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        <button type="submit" class="btn ripple btn-main-primary btn-block">Sign In</button>
                    </form>
                    <div class="text-start mt-5 ms-0"> 
                        <div class="mb-1">@if (Route::has('password.request'))<a href="{{ route('password.request') }}">Forgot password?</a>@endif</div>
                        <div>Don't have an account? <a href="#">Register Here</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
