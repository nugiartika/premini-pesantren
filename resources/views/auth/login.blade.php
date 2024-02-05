@extends('layouts.app')

@section('content')

<style>
     .container {
        position: fixed;
        width: 100vw;
        height: 100vh;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-gap: 6rem;
        padding: 0 2rem;
    }

    .img {
        background: url('{{ asset("storage/img/LOGIN.png") }}') no-repeat center center fixed;
        background-size: 65% 65%;
        background-position:63% 40%;
        display: flex;
        justify-content: center;
        align-items: center;
        grid-column: 2 / 3;
        grid-row: 1 / 2;
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
        color: #28a745;
    }

    .row.mb-3 {
        max-width: 380px;
        width: 85%;
        height: 55px;
        background-color: #E3E1D9;
        margin: 10px 0;
        border-radius: 55px;
        display: grid;
        grid-template-columns: 15% 85%;
        padding: 0 .4rem;
    }

    .row.mb-3 i {
        text-align: center;
        line-height: 55px;
        color: #28a745;
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
        color: #28a745;
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
        background-image: linear-gradient(to right, #28a745, #28a745, #28a745);
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

    /* .background-img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
    } */
</style>

<div class="container">
    {{-- <div class="background-img">
        <img src="{{ asset('storage/img/LOGIN.png') }}" alt="">
    </div> --}}
    <div class="img"></div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="login-container">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <h2>LOGIN</h2>
                        <div class="row mb-3">
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
                                <p>Belum Punya Akun?<a href="{{ route('register') }}"> Register</a></p>
                                {{-- @if (Route::has('password.request'))
                                    <a class="btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif --}}
                        </div>
                        <div class="text">
                      </div>
                  </form>
            </div>
        </div>
    </div>

</div>
<script>
    // Mengatur ukuran gambar latar belakang sesuai ukuran jendela browser
    window.addEventListener('resize', function() {
        var backgroundImg = document.querySelector('.background-img img');
        var container = document.querySelector('.container');
        var containerWidth = container.offsetWidth;
        var containerHeight = container.offsetHeight;

        backgroundImg.style.width = containerWidth + 'px';
        backgroundImg.style.height = containerHeight + 'px';
    });

    // Inisialisasi ukuran gambar latar belakang saat halaman dimuat
    window.addEventListener('load', function() {
        var backgroundImg = document.querySelector('.background-img img');
        var container = document.querySelector('.container');
        var containerWidth = container.offsetWidth;
        var containerHeight = container.offsetHeight;

        backgroundImg.style.width = containerWidth + 'px';
        backgroundImg.style.height = containerHeight + 'px';
    });
</script>
@endsection
