@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="verify-card card">
            <div class="verify-card__icon mb-3">
                    <i class="fa fa-cut" aria-hidden="true"></i>
                </div>
                <div class="verify-card__header heading mb-3">{{ __('
                    Transfer this book to another user account.') }} <br> This process is irreversible.</div>

                <div class="verify-card__body w-100">
                    <form method="POST" action="{{ route('book-request-transfer', $id) }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-12 col-form-label ">{{ __('Email Address') }}</label>

                            <div class="col-md-12">
                                <input id="email" 
                                type="email" class="form-control @error('email') is-invalid @enderror" 
                                name="email"
                                 required>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="">
                                <button type="submit" class="btn btn__primary">
                                    {{ __('Transfer book') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
