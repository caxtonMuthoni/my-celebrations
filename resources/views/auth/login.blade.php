@extends('layouts.app')

@section('content')
<div class="overlay_login particles-js" id="particles-js"></div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 auth-card__container">
            <div class="auth-card shadow-sm">
                <div class="auth-card__header">
                    <div class="fas fa-unlock-alt text__primary mb-2"></div>
                    <h3 class="auth-card__header--text mt-2">Sign In</h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class=" col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row ps-0">
                                <div class="col-md-6">
                                    <label for="password" class="text-md-start text-dark nav-link ps-0 ms-0">{{ __('Password') }}</label>
                                </div>
                                @if (Route::has('password.request'))
                                <div class="col-md-6">
                                    <a class="nav-link text-md-end" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                                @endif
                            </div>

                            <div class="">
                                <!-- <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"> -->
                                <password-input-component />
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-0">
                            <div class="">
                                <button type="submit" class="btn btn__primary offset-md-4">
                                    {{ __('Sign in to your account') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="dropdown-divider mt-2"></div>
                    <div class="mt-3 auth-card__socials">
                          <h5>OR</h5>
                        <a href="{{ url('auth/google') }}" class="btn btn-sm">
                            <img class="btn__socials" src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" style="margin-left: 3em;">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection