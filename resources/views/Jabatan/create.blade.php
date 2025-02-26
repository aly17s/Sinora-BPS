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
        <h1>Tambah Jabatan</h1>
        <form action="{{ route('website.manajemen_jabatan.input') }}" method="post">
            @csrf
            <div class="mb-3">
                <label form="Jabatan" class="form-label">Nama Jabatan</label>
                <input type="text" class="form-control" id="Jabatan" name="Jabatan">
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
            <button type="button" class="btn btn-primary" onclick="window.history.back()">Kembali</button>

        </form>
    </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>