@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="verify-card shadow-sm">
                <div class="verify-card__icon mb-3">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                </div>
                <div class="verify-card__header heading mb-3">{{ __('Verify Your Email Address') }}</div>

                <div class="verify-card__body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    <p class="paragraph px-5 text-center">
                    We have sent you an email message with a confirmation link. Click the link in the email message to confirm your email address.
                    </p>
                    <form class="mt-5" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn__primary">{{ __('RESEND VERIFICATION EMAIL') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
