<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Surat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/form_style.css') }}">
</head>
<body>
    <div class="background-blur">
    <div class="container">
        <button type="button" class="btn btn-primary" onclick="window.history.back()" style="margin-bottom: 10px">Kembali</button>
        <div class="row">
            <!-- Bagian Kiri: Penampil PDF -->
            <div class="col-md-6" style="height: 80vh;">
                @if (!empty($suratmasuk->FileLampiran))
                    <div class="d-flex mb-2">
                        <button class="btn btn-primary me-2" onclick="showFile('surat')">Lihat Surat</button>
                        <button class="btn btn-warning" onclick="showFile('lampiran')">Lihat Lampiran</button>
                    </div>
                @endif
                
                <iframe id="fileViewer" src="{{ asset('uploads/surat_masuk/' . $suratmasuk->FileSurat) }}" frameborder="0" style="width: 100%; height: 90%; "></iframe>
            </div>


            <!-- Bagian Kanan: Detail Surat -->
            <div class="col-md-6 p-4" style="height: 80vh; overflow: auto;">
                <h3>Detail Surat</h3>
                <p><strong>No. Surat:</strong> {{ $suratmasuk->NoSurat }}</p>
                <p><strong>Tanggal Surat:</strong> {{ \Carbon\Carbon::parse($suratmasuk->TanggalSurat)->translatedFormat('d F Y') }}</p>
                <p><strong>Tanggal Penerimaan:</strong> {{ \Carbon\Carbon::parse($suratmasuk->TanggalTerima)->translatedFormat('d F Y') }}</p>
                <p><strong>Dari:</strong> {{ $suratmasuk->Dari }}</p>
                <p><strong>Tingkat Keamanan:</strong> {{ $suratmasuk->TingkatKeamanan }}</p>
                <p><strong>Ringkasan Surat:</strong> {{ $suratmasuk->Ringkasan }}</p>
                <p><strong>Status:</strong> {{ $suratmasuk->Status }}</p>
                @if ($suratmasuk->Status === 'Belum di tindak lanjuti' && !empty($suratmasuk->disposisi))
                    <p><strong>Isi Disposisi:</strong> {{ $suratmasuk->disposisi }}</p>
                @endif

                @if ($suratmasuk->Status === 'Selesai')
                    @if (Auth::user()->roletype !== 'pegawai')
                        <p><strong>Isi Disposisi:</strong> {{ $suratmasuk->disposisi }}</p>
                    @endif

                    <p><strong>Penindaklanjut</strong></p>
                    <ul>
                        @forelse ($tindaklanjutList as $tindaklanjut)
                            <li>
                                <strong>{{ $tindaklanjut->user->name ?? 'User Tidak Diketahui' }}</strong>
                            </li>
                        @empty
                            <li><em>Belum ada tindak lanjut untuk surat ini.</em></li>
                        @endforelse
                    </ul>
                @endif


                <p><strong>File Surat:</strong> 
                    <a href="{{ asset('uploads/surat_masuk/' . $suratmasuk->FileSurat) }}" target="_blank" class="btn btn-info btn-sm">Unduh File</a>
                </p>

                @if (!empty($suratmasuk->FileLampiran))
                    <p><strong>File Lampiran:</strong></p>
                        <a href="{{ asset('uploads/surat_masuk/' . $suratmasuk->FileLampiran) }}" target="_blank" class="btn btn-warning btn-sm">Unduh Lampiran</a>
                    </p>
                @endif

                @php
                    use App\Models\Tindaklanjut;
                    use Illuminate\Support\Facades\Auth;

                    $tindakLanjutKosong = Tindaklanjut::where('surat_masuk_id', $suratmasuk->id)
                        ->where('user_id', Auth::id()) // Hanya cek untuk user yang sedang login
                        ->whereNull('isi_tindaklanjut') // Cek yang masih kosong
                        ->exists();
                @endphp

                <td>
                    @if ($suratmasuk->Status === 'Belum Disposisi')
                        <a href="{{ route('website.surat_masuk.disposisi', $suratmasuk->id) }}" class="btn btn-info btn-sm">Disposisi</a>
                    @endif

                    @if ($suratmasuk->Status === 'Belum di tindak lanjuti')
                        @if ($tindakLanjutKosong)
                            <a href="{{ route('website.surat_masuk.tindaklanjut', $suratmasuk->id) }}" class="btn btn-success btn-sm">Tindak Lanjut</a>
                        @endif
                    @endif
                    
                </td>
            </div>

        </div>
    </div>
    </div>
    <script>
        //tampilan surat
        function showFile(type) {
            let fileViewer = document.getElementById('fileViewer');
            if (type === 'surat') {
                fileViewer.src = "{{ asset('uploads/surat_masuk/' . $suratmasuk->FileSurat) }}";
            } else if (type === 'lampiran') {
                fileViewer.src = "{{ asset('uploads/surat_masuk/' . $suratmasuk->FileLampiran) }}";
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
