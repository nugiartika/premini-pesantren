@extends('layouts.app')

@section('content')
    <style>
        h2 {
            color: #28a745;
        }

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

            .img img {
                width: 1232px;
                height: 598px;
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

        body {
            background-image: url('nama_file_gambar.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }

        .mb-3 {
            max-width: 380px;
            width: 65%;
            height: 55px;
            background-color: #E3E1D9;
            margin: 10px 0;
            border-radius: 55px;
            display: grid;
            grid-template-columns: 15% 85%;
            padding: 0 .4rem;
        }

        .mb-3 i {
            text-align: center;
            line-height: 55px;
            color: #28a745;
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
            color: #28a745;
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
            background-image: linear-gradient(to right, #28a745, #28a745, #28a745);
            cursor: pointer;
            color: #ffffff;
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
        <div class="img mb-5">
            <img src="{{ asset('storage/img/REGISTER.jpg') }}" alt="">
        </div>
        <div class="row justify-content-center mt-2">
            <div class="col-md-8">

                <div class="card-body z-20">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <h2>Register</h2>

                        <div class="mb-3">
                            <i class="fas fa-user"></i>
                            <input class="input" id="name" type="text"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autocomplete="name"
                                autofocus>

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <i class="fas fa-envelope"></i>
                            <input class="input" id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                placeholder="{{ __('Email Address') }}" value="{{ old('email') }}" required
                                autocomplete="email">

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <i class="fas fa-lock"></i>
                            <input class="input" id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                placeholder="{{ __('Password') }}" required autocomplete="new-password">

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <i class="fas fa-lock"></i>
                            <input class="input" id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required
                                autocomplete="new-password">
                        </div>

                          <div class="input-box button">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                          </div>
                          <div class="text">
                            <p>Sudah Punya Akun?<a href="{{ route('login') }}"> Login</a></p>
                          </div>




                    </form>
                </div>
            </div>
        </div>
    @endsection
