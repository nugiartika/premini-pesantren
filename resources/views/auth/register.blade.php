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

        .mb-3 input {
            background: none;
            outline: none;
            border: 1px solid #ced4da; /* Menambahkan border dengan warna abu-abu */
            line-height: 1;
            font-weight: 600;
            font-size: 1.1rem;
            color: #333;
            width: 100%; /* Menyesuaikan lebar input */
            padding: 10px; /* Menambahkan padding agar input tidak terlalu dekat dengan tepi */
        }

        .mb-3 textarea {
            background: none;
            outline: none;
            border: 1px solid #ced4da; /* Menambahkan border dengan warna abu-abu */
            line-height: 1;
            font-weight: 600;
            font-size: 1.1rem;
            color: #333;
            width: 100%; /* Menyesuaikan lebar input */
            padding: 10px; /* Menambahkan padding agar input tidak terlalu dekat dengan tepi */
        }

        .mb-3 {
            max-width: 100%; /* Menyesuaikan lebar maksimum input */
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px; /* Memberikan sedikit ruang antara input */
        }

        .mb-3 label {
            flex: 1;
            margin-right: 20px;
        }

        .mb-3 input,
        .mb-3 textarea {
            flex: 2;
        }

       label{
            line-height: 30px;
            color: #28a745;
            font-size: 1.1rem;
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

        /* Script CSS */
        .slide {
            display: none;
        }

        .slide.active {
            display: block;
        }

    </style>

    <div class="container">
        <div class="img mb-5">
            <img src="{{ asset('storage/img/REGISTER.jpg') }}" alt="">
        </div>
        <div class="row justify-content-center mt-2">
            <div class="col-md-8">
                <div class="card-body z-20">
                    @if(session('success_message'))
                        <div class="alert alert-success">
                            {{ session('success_message') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('pendaftaran.store') }}">
                        @csrf

                        <div class="slide active" id="slide1">
                            <div class="row g-3">
                                <div class="col">
                                <label for="nama" class="form-label">{{ __('Nama') }}</label>
                                <input class="input form-control @error('nama') is-invalid @enderror" id="nama" type="text"
                                    name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus>
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col">
                                <label for="nisn" class="form-label">{{ __('NISN') }}</label>
                                <input class="input form-control @error('nisn') is-invalid @enderror" id="nisn" type="number"
                                    name="nisn" value="{{ old('nisn') }}" required autocomplete="nisn" autofocus>
                                @error('nisn')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col">
                                <label for="telepon" class="form-label">{{ __('Telepon') }}</label>
                                <input class="input form-control @error('telepon') is-invalid @enderror" id="telepon" type="number"
                                    name="telepon" value="{{ old('telepon') }}" required autocomplete="telepon" autofocus>
                                @error('telepon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col">
                                <label class="form-label">{{ __('Jenis kelamin') }}</label>
                                <div class="row">
                                    <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input @error('jenis_kelamin') is-invalid @enderror" type="radio" name="jenis_kelamin" id="jenis_kelamin_laki" value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }}>
                                        <label style="color: #000;" class="form-check-label" for="jenis_kelamin_laki">Laki-laki</label>
                                    </div>
                                    </div>
                                <div class="col-auto">
                                    <div class="form-check" style="margin-left: 10px;">
                                        <input class="form-check-input @error('jenis_kelamin') is-invalid @enderror" type="radio" name="jenis_kelamin" id="jenis_kelamin_perempuan" value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }}>
                                        <label style="color: #000;" class="form-check-label" for="jenis_kelamin_perempuan">Perempuan</label>
                                    </div>
                                </div>
                                </div>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                            <div class="row g-3">
                                <div class="col">
                                    <label for="tempat_lahir" class="form-label">{{ __('Tempat Lahir') }}</label>
                                    <input class="input form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" type="text"
                                        name="tempat_lahir" value="{{ old('tempat_lahir') }}" required autocomplete="tempat_lahir" autofocus>
                                    @error('tempat_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col">
                                    <label for="tanggal_lahir" class="form-label">{{ __('Tanggal Lahir') }}</label>
                                    <input class="input form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" type="date"
                                        name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required autocomplete="tanggal_lahir" autofocus>
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </div>
                                </div>




                                <label for="alamat" class="form-label">{{ __('Alamat') }}</label>
                                <textarea class="input form-control @error('alamat') is-invalid @enderror" id="alamat" type="text"
                                    name="alamat" value="{{ old('alamat') }}" required autocomplete="alamat" autofocus></textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            <div class="row g-3">
                                <div class="col"></div>
                                <div class="col">
                            <button type="button" class="btn btn-primary next-slide">Next</button>
                                </div></div>
                        </div>

                        <div class="slide" id="slide2">
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input class="input form-control @error('email') is-invalid @enderror" id="email" type="email"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input class="input form-control @error('password') is-invalid @enderror" id="password" type="password"
                                    name="password" required autocomplete="new-password">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password-confirm" class="form-label">{{ __('Password Confirm') }}</label>
                                <input class="input form-control" id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <input type="hidden" name="status" value="menunggu konfirmasi">
                            <div class="row g-3">
                                <div class="col">
                            <button type="button" class="btn btn-primary prev-slide">Previous</button></div>
                            <div class="col">
                            <div class="input-box button">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button></div>
                            </div>
                        </div>
                        </div>
                        <div class="text">
                            <p>Sudah Punya Akun?<a href="{{ route('login') }}"> Login</a></p>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.slide');
            let currentSlide = 0;

            function showSlide(slideIndex) {
                slides.forEach((slide, index) => {
                    if (index === slideIndex) {
                        slide.style.display = 'block';
                    } else {
                        slide.style.display = 'none';
                    }
                });
            }

            document.querySelector('.next-slide').addEventListener('click', function() {
                currentSlide++;
                showSlide(currentSlide);
            });

            document.querySelector('.prev-slide').addEventListener('click', function() {
                currentSlide--;
                showSlide(currentSlide);
            });
        });
    </script>

@endsection
