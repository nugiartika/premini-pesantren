@extends('layouts.app')

@section('content')

<style>
    .container {
        position: fixed;
        width: 100vw;
        height: 100vh;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-gap: 7rem;
        padding: 0 2rem;
    }

    .container:before {
        content: '';
        position: absolute;
        width: 2000px;
        height: 2000px;
        border-radius: 50%;
        background: linear-gradient(-45deg, #42be32, #2aae82, #33e6ab);
        top: -10%;
        left: 48%;
        transform: translateY(-50%);
    }

    .img {
        position: relative;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        transform: translate(20%, 0);
    }

    .img img {
        width: 100%;
    }

    .login-container {
        display: flex;
        justify-content: flex-start;
        transform: translate(20%, 30%);
        grid-column: 1 / 2;
        grid-row: 1 / 2;
    }

    form {
        width: 360px;
    }

    form h2 {
        font-size: 2.9rem;
        text-transform: uppercase;
        margin: 15px 0;
        color: #333;
    }

    .row.mb-3 {
        max-width: 380px;
        width: 85%;
        height: 55px;
        background-color: #f0f0f0;
        margin: 10px 0;
        border-radius: 55px;
        display: grid;
        grid-template-columns: 15% 85%;
        padding: 0 .4rem;
    }

    .row.mb-3 i {
        text-align: center;
        line-height: 55px;
        color: #acacac;
        font-size: 1.1rem;
    }

    .row.mb-3 input {
        background: none;
        outline: none;
        border: none;
        line-height: 1;
        font-weight: 600;
        font-size: 1.1rem;
        color: #333;
    }

    .row.mb-3 input::placeholder {
        color: #aaa;
        font-weight: 500;
    }

    .btn-link {
        display: block;
        text-align: right;
        text-decoration: none;
        color: #999;
        font-size: 0.9rem;
        transition: .3s;
        margin-top: 1rem;
    }

    .btn-link:hover {
        color: #38d39f;
    }

    .row.mb-4 {
        display: flex;
        margin: 10px 0;
        display: grid;
        grid-template-columns: 50% 85%;
        padding: 0 .4rem;
    }

    .row.mb-5 {
        display: flex;
        margin: 10px 0;
        display: grid;
        padding: 0 .4rem;
    }

    .btn.btn-primary {
        display: inline-block;
        margin-top: 1rem;
        width: 85%;
        height: 50px;
        border-radius: 25px;
        margin-bottom: 1rem;
        font-size: 1.2rem;
        outline: none;
        border: none;
        background-image: linear-gradient(to right, #32be8f, #38d39f, #39a983);
        cursor: pointer;
        color: #fff;
        font-display: 'Poppins', sans-serif;
        background-size: 200%;
        transition: .5s;
        position: relative;
    }

    .btn.btn-primary:hover {
        background-position: right;
    }

</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="login-container">
            {{-- <div class="card"> --}}
                {{-- <div class="card-header">{{ __('Login') }}</div> --}}

                {{-- <div class="card-body"> --}}
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <h2>Welcome</h2>
                        <div class="row mb-3">

                            {{-- <div class="col-md-6 one"> --}}
                                {{-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label> --}}
                                <i class="fas fa-user"></i>
                                <input class="input" id="email" type="email" placeholder="{{ __('Email Address') }}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="row mb-3">

                                    <i class="fas fa-lock"></i>
                                    <input class="input" id="password" type="password" placeholder="{{ __('Password') }}" class="form-control input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="row mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                        </div>

                        <div class="row mb-5">
                                <button type="submit" class="btn btn-primary mt-3">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                        </div>
                  </form>
            </div>
        </div>
    </div>
    {{-- <div class="img">
        <img src="{{ asset('storage/img/Mobile_login-bro__5_-removebg-preview.png') }}" alt="Foto">
    </div> --}}
</div>
@endsection
