@section('content')

<form class="row g-3">
    <div class="col-md-6">
      <label for="nama_lengkap" class="form-label">nama_lengkap</label>
      <input type="text" class="form-control" name="nama_lengkap" value="{{ old('nama_lengkap')}}">
    </div>
    <div class="col-md-6">
      <label for="jenis_kelamin" class="form-label">jenis kelamin</label>
      <select class="form-select" name="jenis_kelamin" aria-label="Default select example">
        <option value="" {{ old('kategori_id') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
        <option value="" {{ old('kategori_id') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
      </select>
    </div> 
    <div class="col-12">
      <label for="nik" class="form-label">nik</label>
      <input type="text" class="form-control" name="nik" value="{{ old('nik')}}">
    </div>
    <div class="col-12">
        <label for="tempat_lahir" class="form-label">tempat_lahir</label>
        <input type="text" class="form-control" name="tempat_lahir" value="{{ old('tempat_lahir')}}">
    </div>
    <div class="col-md-6">
        <label for="tanggal_lahir" class="form-label">tanggal_lahir</label>
        <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir')}}">
    </div>
    <div class="col-md-6">
        <label for="alamat_lengkap" class="form-label">alamat_lengkap</label>
        <textarea type="text" class="form-control" name="alamat_lengkap">{{ old('alamat_lengkap')}}</textarea>
    </div>
    <div class="col-md-6">
        <label for="tempat_tinggal" class="form-label">tempat_tinggal</label>
        <input type="date" class="form-control" name="tempat_tinggal" value="{{ old('tempat_tinggal')}}">
    </div>
    <div class="col-md-6">
        <label for="tanggal_lahir" class="form-label">tanggal_lahir</label>
        <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir')}}">
    </div>
    <div class="col-md-4">
      <label for="inputState" class="form-label">State</label>
      <select id="inputState" class="form-select">
        <option selected>Choose...</option>
        <option>...</option>
      </select>
    </div>
    <div class="col-md-2">
      <label for="inputZip" class="form-label">Zip</label>
      <input type="text" class="form-control" id="inputZip">
    </div>
    <div class="col-12">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="gridCheck">
        <label class="form-check-label" for="gridCheck">
          Check me out
        </label>
      </div>
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-primary">Sign in</button>
    </div>
  </form>
