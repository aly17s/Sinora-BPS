<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BPS Ogan Ilir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/form_style.css') }}">
</head>
<body>
    <div class="background-blur">
    <div class="container">
        <h1>Edit Data Pengguna</h1>
        <form action="{{ route('website.manajemen_anggota.update', $user->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label form="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" value="{{ $user->name }}" name="name">
            </div>
            <div class="mb-3">
                <label form="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" value="{{ $user->email }}" name="email">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password (kosongkan jika tidak ingin mengubah Password)</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label form="jabatan" class="form-label">Jabatan</label>
                <select class="form-control" id="jabatan" name="jabatan">
                  <option value="" selected disabled>Pilih Jabatan</option>
                  @foreach ($jabatans as $jabatan)
                      <option value="{{ $jabatan->Jabatan }}"{{ $user->jabatan == $jabatan->Jabatan ? 'selected' : '' }}>
                        {{ $jabatan->Jabatan }}</option>
                  @endforeach
                </select>
            </div>
            <div class="mb-3">
              <label for="roletype" class="form-label">Role</label>
              <select name="roletype" id="roletype" class="form-control">
                <option value="pegawai" {{ $user->roletype == 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                <option value="kepala" {{ $user->roletype == 'kepala' ? 'selected' : '' }}>Kepala</option>
                <option value="admin" {{ $user->roletype == 'admin' ? 'selected' : '' }}>Admin</option>
              </select>
          </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>