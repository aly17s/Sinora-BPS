<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINORA - SURAT MASUK</title>
    <!-- Link ke CSS dari folder public -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Acme&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        th#no, td#no {
            width: 2%;
            text-align: center;
        }

        th#no2, td#no2 {
            padding: 10px;
            width: 13%;
        }

        th#no3, td#no3 {
            width: 10%;
            text-align: center;
        }

        th#no4, td#no4 {
            width: 10%;
            text-align: center;
        }

        th#no5, td#no5 {
            width: 10%;
            text-align: center;
        }

        th#no6, td#no6 {
            width: 10%;
            text-align: center;
        }

        th#no7, td#no7 {
            width: 10%;
            text-align: center;
        }

        th#no8, td#no8 {
            padding: 10px;
            width: 15%;
        }

        th#no9, td#no9 {
            width: 10%;
            text-align: center;
        }

        th#no10, td#no10 {
            width: 10%;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="background-blur">
        <div class="top-bar">
            <h1 class="app-name" style="color: #0093DD">SINO<span style="color: #242424">RA</span></h1>
            <h1 id="hallo" class="app-name" style="color: #242424"></h1>
        </div>
        <div class="side-bar">
            <h6>HOME</h6>
            <a href="dashboard">Dashboard</a>
            @if(Auth::user()->roletype !== 'pegawai')
                    <a href="people_management">Manajemen Anggota</a>
                    <a href="job_management">Manajemen Jabatan</a>
                @endif
            <h6>SURAT MASUK</h6>
            <a href="" id="current-menu">Surat Masuk</a>
            <a href="archive">Arsip</a>
            <h6>SURAT KELUAR</h6>
            <a href="outbox">Surat Keluar</a>
            {{-- <a href="classify">Klasifikasi</a> --}}
            <div class="settings-container">
                <h6>USER SETTINGS</h6>
                <a href="settings">Settings</a>
                <form id="lo" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button id="logout-button" type="submit" >Logout</button>
                </form>
            </div>
        </div>
        <div class="title">
            <h1>SURAT MASUK</h1>
            <a href="{{ route('website.surat_masuk.create') }}" type="button" class="btn btn-primary"
            @if(Auth::user()->roletype == 'pegawai' || Auth::user()->roletype =='kepala')
                style="display:none;"
            @endif
            >Tambah Surat Masuk</a>

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
        </div>
        <div id="o1" class="content">
            <table>
                <thead>
                    <tr>
                        <th id="no">#</th>
                        <th id="no2">No. Surat</th>
                        <th id="no3">Tanggal Surat</th>
                        <th id="no4">Tanggal Penerimaan</th>
                        <th id="no5">Dari</th>
                        <th id="no6">Tingkat Keamanan</th>
                        <th id="no7">Status</th>
                        <th id="no8">Ringkasan</th>
                        <th id="no9">File Surat</th>
                        <th id="no10">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($surat_masuks as $suratmasuk)
                    <tr>
                        <td id="no">{{ $loop->iteration }}</td>
                        <td id="no2">{{ $suratmasuk->NoSurat }}</td>
                        <td id="no3">{{ \Carbon\Carbon::parse($suratmasuk->TanggalSurat)->translatedFormat('d F Y') }}</td>
                        <td id="no4">{{ \Carbon\Carbon::parse($suratmasuk->TanggalTerima)->translatedFormat('d F Y') }}</td>
                        <td id="no5">{{ $suratmasuk->Dari }}</td>
                        <td id="no6">{{ $suratmasuk->TingkatKeamanan }}</td>
                        <td id="no7">{{ $suratmasuk->Status }}</td>
                        <td id="no8">{{ $suratmasuk->Ringkasan }}</td>
                        <td id="no9">
                            <a href="{{ route('website.surat_masuk.lihat', $suratmasuk->id) }}" type="button" class="btn btn-primary">Lihat File</a>
                        </td>
                        <td id="no10">
                            @if($suratmasuk->Status !== 'Belum di tindak lanjuti')
                                <form action="{{ route('website.surat_masuk.hapus', $suratmasuk->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @else
                                <!-- Tidak tampilkan tombol hapus jika status adalah 'Belum di tindak lanjuti' -->
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>

    <script>
        //greeting
        document.addEventListener('DOMContentLoaded', function() {
            var currentHour = new Date().getHours();
            var greeting = '';
    
            if (currentHour >= 5 && currentHour < 10) {
                greeting = 'Selamat Pagi';
            } else if (currentHour >= 10 && currentHour < 14) {
                greeting = 'Selamat Siang';
            } else if (currentHour >= 14 && currentHour < 18) {
                greeting = 'Selamat Sore';
            } else {
                greeting = 'Selamat Malam';
            }
    
            document.getElementById('hallo').textContent = greeting + ', {{ Auth::user()->name }}';

            document.getElementById("logout-button").addEventListener("click", function (event) {
            event.preventDefault(); 

                Swal.fire({
                    title: "Apakah Anda yakin ingin logout?",
                    text: "Anda akan keluar dari sesi ini.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, Logout!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById("lo").submit();
                    }
                });
            });
        });
    </script>
</body>
</html>