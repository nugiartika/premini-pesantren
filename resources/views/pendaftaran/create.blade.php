@extends('layouts.app')

@section('content')

<div class="card mx-auto" style="width: 70%;">
    <div class="card-body">
<form action="{{ route('pendaftaran.store') }}" method="POST" class="row g-3">
    @csrf
    <div class="col-md-6">
      <label for="nama_lengkap" class="form-label">nama_lengkap</label>
      <input type="text" class="form-control" name="nama_lengkap"  value="{{ old('nama_lengkap')}}">
    </div>
    <div class="col-md-6">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" name="email"  value="{{ old('email')}}">
    </div>

    <div class="col-md-6">
        <label for="jenis_kelamin" class="form-label">jenis kelamin</label>
        <select id="jenis_kelamin" name="jenis_kelamin" class="form-select">
            <option value="" {{ old('jenis_kelamin') == '' ? 'selected' : '' }}>- Pilih jenis kelamin -</option>
            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>
    </div>
    <div class="col-md-6">
      <label for="nik" class="form-label">NIK</label>
      <input type="number" class="form-control" name="nik"  value="{{ old('nik')}}">
    </div>
    <div class="col-md-6">
      <label for="tempat_lahir" class="form-label">tempat_lahir</label>
      <input type="text" class="form-control" name="tempat_lahir"  value="{{ old('tempat_lahir')}}">
    </div>
    <div class="col-md-6">
      <label for="tanggal_lahir" class="form-label">tanggal_lahir</label>
      <input type="date" class="form-control" name="tanggal_lahir"  value="{{ old('tanggal_lahir')}}">
    </div>
    <div class="col-md-6">
      <label for="alamat" class="form-label">alamat</label>
      <textarea type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat">{{ old('alamat') }}</textarea>
    </div>
    <div class="col-md-6">
        <label for="tempat_tinggal" class="form-label">tempat tinggal</label>
        <select id="tempat_tinggal" name="tempat_tinggal" class="form-select">
            <option value="" {{ old('tempat_tinggal') == '' ? 'selected' : '' }}>- Pilih jenis kelamin -</option>
            <option value="Bersama orang tua/wali" {{ old('tempat_tinggal') == 'Bersama orang tua/wali' ? 'selected' : '' }}>Bersama orang tua/wali</option>
            <option value="kos" {{ old('tempat_tinggal') == 'kos' ? 'selected' : '' }}>kos</option>
            <option value="Asrama/Pondok Pesantren" {{ old('tempat_tinggal') == 'Asrama/Pondok Pesantren' ? 'selected' : '' }}>Asrama/Pondok Pesantren</option>
            <option value="Panti Asuhan" {{ old('tempat_tinggal') == 'Panti Asuhan' ? 'selected' : '' }}>Panti Asuhan</option>
            <option value="lainnnya" {{ old('tempat_tinggal') == 'lainnnya' ? 'selected' : '' }}>lainnnya</option>
        </select>
    </div>
    <div class="col-md-6">
    <label for="nama_ortu" class="form-label">nama_ortu</label>
    <input type="text" class="form-control" name="nama_ortu"  value="{{ old('nama_ortu')}}">
    </div>
    <div class="col-md-6">
    <label for="pendidikan_ortu" class="form-label">pendidikan_ortu</label>
    <input type="text" class="form-control" name="pendidikan_ortu"  value="{{ old('pendidikan_ortu')}}">
    </div>
    <div class="col-md-6">
    <label for="pekerjaan_ortu" class="form-label">pekerjaan_ortu</label>
    <input type="text" class="form-control" name="pekerjaan_ortu"  value="{{ old('pekerjaan_ortu')}}">
    </div>
    <div class="col-md-6">
    <label for="sekolah_asal" class="form-label">sekolah_asal</label>
    <input type="text" class="form-control" name="sekolah_asal"  value="{{ old('sekolah_asal')}}">
    </div>
    <div class="col-md-6">
    <label for="telepon_rumah" class="form-label">telepon_rumah</label>
    <input type="number" class="form-control" name="telepon_rumah"  value="{{ old('telepon_rumah')}}">
    </div>

    <div class="col-12">
      <button type="submit" class="btn btn-primary">Daftar</button>
    </div>
  </form>
</div>
</div>

  @endsection
