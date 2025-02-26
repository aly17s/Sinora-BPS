<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tindak Lanjut</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/form_style.css') }}">
</head>
<body>
    <div class="background-blur">
    <div class="container">
        <h3>Tindak Lanjut</h3>
        <form action="{{ route('website.surat_masuk.finish', $suratmasuk->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label"><strong>No. Surat</strong></label>
                <input type="text" class="form-control" value="{{ $suratmasuk->NoSurat }}" readonly>
            </div>
            
            <div class="mb-3">
                <label class="form-label"><strong>Tanggal Surat</strong></label>
                <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($suratmasuk->TanggalSurat)->translatedFormat('d F Y') }}" readonly>
            </div>
            
            <div class="mb-3">
                <label class="form-label"><strong>Dari</strong></label>
                <input type="text" class="form-control" value="{{ $suratmasuk->Dari }}" readonly>
            </div>
            
            <div class="mb-3">
                <label class="form-label"><strong>Tingkat Keamanan</strong></label>
                <input type="text" class="form-control" value="{{ $suratmasuk->TingkatKeamanan }}" readonly>
            </div>
            
            <div class="mb-3">
                <label class="form-label"><strong>Ringkasan Surat</strong></label>
                <textarea class="form-control" rows="3" readonly>{{ $suratmasuk->Ringkasan }}</textarea>
            </div>
            
            <div class="mb-3">
                <label class="form-label"><strong>Status</strong></label>
                <input type="text" class="form-control" value="{{ $suratmasuk->Status }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Isi Disposisi</strong></label>
                <textarea class="form-control" rows="2" readonly>{{ $suratmasuk->disposisi }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Tindak Lanjut</strong></label>
                <textarea name="tindaklanjut" class="form-control" rows="2" required></textarea>
            </div>  
            <button type="submit" class="btn btn-primary">Tindak Lanjuti</button>
            <button type="button" class="btn btn-primary" onclick="window.history.back()">Kembali</button>
        </form>
    </div>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

                