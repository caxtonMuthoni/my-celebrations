@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 auth-card__container">
            <div class="auth-card shadow-sm">
                <div class="auth-card__header">
                    <div class="fas fa-edit text__primary mb-2"></div>
                    <h3 class="auth-card__header--text mt-2">Create an account</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="">{{ __('Full Name') }}</label>

                            <div class="">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row col-md-12">
                        <div class="mb-3 col-md-6">
                            <label for="email" class="">{{ __('Email Address') }}</label>

                            <div class="">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="phonenumber" class="">{{ __('Your phone number') }}</label>

                            <div class="">
                                <input id="phonenumber" type="text" class="form-control @error('phonenumber') is-invalid @enderror" name="phonenumber" value="{{ old('phonenumber') }}" required autocomplete="phonenumber">

                                @error('phonenumber')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        </div>

                        <div class="col-md-12 row">
                        <div class="mb-3 col-md-6">
                            <label for="password" class="">{{ __('Password') }}</label>

                            <div class="">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="password-confirm" class="">{{ __('Confirm Password') }}</label>

                            <div class="">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        </div>

                        <div class="mb-0">
                            <div class="offset-md-4">
                                <button type="submit" class="btn btn__primary">
                                    {{ __('create account') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="dropdown-divider mt-2"></div>
                    <div class="mt-3 auth-card__socials">
                        <a href="{{ url('auth/google') }}" class="btn">
                            <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" style="margin-left: 3em;">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection