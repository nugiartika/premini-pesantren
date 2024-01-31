@extends('layouts.app')

@section('content')

<style>
    .container {
        position: fixed;
        width: 100vw;
        height: 100vh;
        background-color: #fff;
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
        background: linear-gradient(-45deg, #32be8f, #38d39f, #32be8f);
        top: -10%;
        right: 48%;
        transform: translateY(-50%);
    }

    .img {
        position: relative;
        display: flex;
        justify-content: flex-end;
        align-items: center; /* Center vertically */
        transform: translate(20%, 0);

    }

    .img img {
        width: 500px;
    }

    .col-md-8 {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
    }

    .card-body {
        position: absolute;
        top: 50%;
        left: 75%;
        transform: translate(-30%, -50%);
        width: 50%;
        display: grid;
        grid-template-columns: 1fr;
    }

    form {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 0 5rem;
        overflow: hidden;
        grid-column: 1 / 2;
        grid-row: 1 / 2;
    }

    .mb-3 {
        max-width: 380px;
        width: 65%;
        height: 55px;
        background-color: #f0f0f0;
        margin: 10px 0;
        border-radius: 55px;
        display: grid;
        grid-template-columns: 15% 85%;
        padding: 0 .4rem;
    }

    .mb-3 i {
        text-align: center;
        line-height: 55px;
        color: #acacac;
        font-size: 1.1rem;
    }

    .mb-3 input {
        background: none;
        outline: none;
        border: none;
        line-height: 1;
        font-weight: 600;
        font-size: 1.1rem;
        color: #333;
    }

    .mb-3 input::placeholder {
        color: #aaa;
        font-weight: 500;
    }

    .btn.btn-primary {
        display: inline-block;
        margin-top: 1rem;
        width: 200px;
        height: 50px;
        border-radius: 25px;
        margin-bottom: 1rem;
        font-size: 1.2rem;
        outline: none;
        border: none;
        background-image: linear-gradient(to right, #32be8f, #38d39f, #39a983);
        cursor: pointer;
        color: #fff;
        font-family: 'Poppins', sans-serif;
        background-size: 200%;
        transition: .5s;
        position: relative;
    }

    .btn.btn-primary:hover {
        background-position: right;
    }

    .panels-container {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
    }
</style>

<div class="container">
    <div class="img">
        <img src="{{ asset('storage/img/Sign_up-amico-removebg-preview.png') }}" alt="Foto">
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- <div class="card"> --}}
                {{-- <div class="card-header">{{ __('REGISTER') }}</div> --}}

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <h2>Register</h2>

                        <div class="mb-3">
                            {{-- <label for="name" class="form-label">{{ __('Name') }}</label> --}}
                            <i class="fas fa-user"></i>
                            <input class="input" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            {{-- <label for="email" class="form-label">{{ __('Email Address') }}</label> --}}
                            <i class="fas fa-envelope"></i>
                            <input class="input" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="{{ __('Email Address') }}" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            {{-- <label for="password" class="form-label">{{ __('Password') }}</label> --}}
                            <i class="fas fa-lock"></i>
                            <input class="input" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Password') }}" required autocomplete="new-password">

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            {{-- <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label> --}}
                            <i class="fas fa-lock"></i>
                            <input class="input" id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required autocomplete="new-password">
                        </div>

                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                 </div>
           {{-- </div>--}}
        {{-- </div> --}}
    </div>
</div>
@endsection
