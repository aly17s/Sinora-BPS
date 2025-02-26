<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINORA - MANAJEMEN ANGGOTA</title>
    <!-- Link ke CSS dari folder public -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Acme&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        th#no, td#no {
            width: 5%;
            text-align: center;
        }

        th#no2, td#no2 {
            width: 30%;
            padding-left: 10px ;
        }

        th#no3, td#no3 {
            width: 30%;
            padding-left: 10px;
        }

        th#no4, td#no4 {
            width: 20%;
            padding-left: 10px;
        }

        th#no5, td#no5 {
            width: 15%;
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
                    <a href="people_management" id="current-menu">Manajemen Anggota</a>
                    <a href="job_management">Manajemen Jabatan</a>
                @endif
            <h6>SURAT MASUK</h6>
            <a href="inbox">Surat Masuk</a>
            <a href="archive">Arsip</a>
            <h6>SURAT KELUAR</h6>
            <a href="outbox">Surat Keluar</a>
            {{-- <a href="classify">Klasifikasi</a> --}}
            <div class="settings-container">
                <h6>USER SETTINGS</h6>
                <a href="settings">Settings</a>
                <form id="lo" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button id="logout-button" type="submit">Logout</button>
                </form>
            </div>
        </div>
        <div class="title">
            <h1>MANAJEMEN ANGGOTA</h1>
            <a href="{{ route('website.manajemen_anggota.create') }}" type="button">Tambah Pengguna</a>
        </div>
        <div id="o1" class="content">
            <table>
                <thead>
                    <tr>
                        <th id="no" scope="col">#</th>
                        <th id="no2" scope="col">Nama</th>
                        <th id="no3" scope="col">Email</th>
                        <th id="no4" scope="col">Jabatan</th>
                        <th id="no5" >Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th id="no" scope="row">{{ $loop->iteration }}</th>
                            <td id="no2">{{ $user->name }}</td>
                            <td id="no3">{{ $user->email }}</td>
                            <td id="no4">{{ $user->jabatan }}</td>
                            <td id="no5">
                                
                                <form id="delettte" action="{{ route('website.manajemen_anggota.hapus', $user->id) }}"method="post">
                                    @csrf
                                    @method('delete')
                                    <a href="{{ route('website.manajemen_anggota.edit', $user->id) }}" type="button" class="btn btn-warning">Edit</a>
                                    <button type="button" class="btn btn-danger delete-btn">Delete</button>
                                </form>
                            </td>
                        </tr>  
                    @endforeach
                </tbody>
                <div class="d-flex justify-content-center">
                    {{ $users->links() }}
                </div>
            </table>
        </div>
    </div>

    <script>
        //peringatan hapus
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".delete-btn").forEach(button => {
                button.addEventListener("click", function() {
                    let form = this.closest("form");

                    Swal.fire({
                        title: "Apakah Anda yakin?",
                        text: "Data yang dihapus tidak bisa dikembalikan!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Ya, Hapus!",
                        cancelButtonText: "Batal"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

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

            //logout
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