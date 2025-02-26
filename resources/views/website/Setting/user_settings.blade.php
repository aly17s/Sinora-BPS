<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINORA - SETTING</title>
    <!-- Link ke CSS dari folder public -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Acme&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

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
            <a href="inbox">Surat Masuk</a>
            <a href="archive">Arsip</a>
            <h6>SURAT KELUAR</h6>
            <a href="outbox">Surat Keluar</a>
            {{-- <a href="classify">Klasifikasi</a> --}}
            <div class="settings-container">
                <h6>USER SETTINGS</h6>
                <a href="" id="current-menu">Settings</a>
                <form id="lo" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button id="logout" type="submit" >Logout</button>
                </form>
                
            </div>
        </div>
        <div class="title">
            <h1>USER SETTINGS</h1>
        </div>

        <form id="settings" method="POST" action="{{ route('Setting.user_settings.update', auth()->user()->id) }}">
            @csrf
            @method('PUT')
            <div class="container">
                <h1>Profil Pengguna</h1>
                <div class="mb-3">
                    <label form="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" value="{{ $user->name }}" name="name">
                </div>
                <div class="mb-3">
                    <label form="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" value="{{ $user->email }}" name="email">
                </div>
                <div class="mb-3">
                    <label form="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <select class="form-control" id="jabatan" name="jabatan" disabled>
                        <option value="" selected disabled>Pilih Jabatan</option>
                        @foreach ($jabatans as $jabatan)
                            <option value="{{ $jabatan->Jabatan }}"{{ $user->jabatan == $jabatan->Jabatan ? 'selected' : '' }}>{{ $jabatan->Jabatan }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="jabatan" value="{{ $user->jabatan }}">
                </div>
                
                <div class="mb-3">
                    <label for="roletype" class="form-label">Role</label>
                    <select name="roletype" id="roletype" class="form-control" disabled>
                        <option value="pegawai" {{ $user->roletype == 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                        <option value="kepala" {{ $user->roletype == 'kepala' ? 'selected' : '' }}>Kepala</option>
                        <option value="admin" {{ $user->roletype == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    <input type="hidden" name="roletype" value="{{ $user->roletype }}">
                </div>
                <button type="submit" id="bttn">Update</button>
            </div>
        </form>
        

    </div>
    

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            //greeting
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
        });
    </script>
</body>
</html>