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
        <h3>Tambah Surat Masuk</h3>
        <form action="{{ route('website.surat_masuk.input') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="NoSurat" class="form-label">Nomor Surat</label>
                <input type="text" class="form-control" id="NoSurat" name="NoSurat">
            </div>
            <div class="mb-3">
                <label for="TanggalSurat" class="form-label">Tanggal Surat</label>
                <input type="date" class="form-control" id="TanggalSurat" name="TanggalSurat">
            </div>
            <div class="mb-3">
                <label for="TanggalTerima" class="form-label">Tanggal Penerimaan</label>
                <input type="date" class="form-control" id="TanggalTerima" name="TanggalTerima">
            </div>
            <div class="mb-3">
                <label for="Dari" class="form-label">Pengirim Surat</label>
                <input type="text" class="form-control" id="Dari" name="Dari">
            </div>
            <div class="mb-3">
                <label for="TingkatKeamanan" class="form-label">Tingkat Keamanan</label>
            <div id="TingkatKeamanan">
                <div>
                    <input type="radio" id="Biasa" name="TingkatKeamanan" value="Biasa" required>
                    <label for="Biasa">Biasa</label>
                </div>
                <div>
                    <input type="radio" id="Rahasia" name="TingkatKeamanan" value="Rahasia" required>
                    <label for="Rahasia">Rahasia</label>
                </div>
                <div>
                    <input type="radio" id="Sangat Rahasia" name="TingkatKeamanan" value="Sangat Rahasia" required>
                    <label for="Sangat Rahasia">Sangat Rahasia</label>
                </div>
                <div>
                    <input type="radio" id="Terbatas" name="TingkatKeamanan" value="Terbatas" required>
                    <label for="Terbatas">Terbatas</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="Status" class="form-label">Status</label>
                <input type="text" class="form-control" id="Status" name="Status" value="Belum Disposisi" readonly>
            </div>           
            <div class="mb-3">
                <label for="Ringkasan" class="form-label">Ringkasan Surat</label>
                <input type="text" class="form-control" id="Ringkasan" name="Ringkasan">
            </div>
            <div class="mb-3">
                <label for="FileSurat" class="form-label">File Surat (.pdf)</label>
                <input type="file" class="form-control" id="FileSurat" name="FileSurat" accept=".pdf">
            </div>

            <div class="mb-3">
                <label for="Lampiran" class="form-label">Lampiran</label>
                <select class="form-control" id="Lampiran" name="Lampiran" onchange="toggleLampiran()">
                    <option value="Tidak ada lampiran">Satu dokumen dengan surat</option>
                    <option value="dengan lampiran">Terpisah dokumen dengan surat</option>
                </select>
            </div>
            <div class="mb-3 d-none" id="LampiranFile">
                <label for="FileLampiran" class="form-label">File Lampiran (.pdf)</label>
                <input type="file" class="form-control" id="FileLampiran" name="FileLampiran" accept=".pdf">
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
            <button type="button" class="btn btn-primary" onclick="window.history.back()">Kembali</button>
        </form>
    </div>
</div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <script>
        //lampiran
        function toggleLampiran() {
            const lampiranSelect = document.getElementById('Lampiran');
            const lampiranFileDiv = document.getElementById('LampiranFile');

            if (lampiranSelect.value === 'dengan lampiran') {
                lampiranFileDiv.classList.remove('d-none');
            } else {
                lampiranFileDiv.classList.add('d-none');
            }
        }
    </script>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>