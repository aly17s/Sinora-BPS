<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINORA - DASHBOARD</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Acme&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    <div class="background-blur">
        <div class="top-bar">
            <h1 class="app-name" style="color: #0093DD">SINO<span style="color: #242424">RA</span></h1>
            <h1 id="hallo" class="app-name" style="color: #242424"></h1>
        </div>
        <div class="side-bar">
            <nav>
            <h6>HOME</h6>
            <a href="" id="current-menu">Dashboard</a>
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
            <a href="settings">Settings</a>
            <form id="lo" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button id="logout-button" type="submit">Logout</button>
                </form>
            </div>

            
        </div>
        <div class="title">
            <h1>DASHBOARD</h1>
        </div>
        {{-- jumlah surat --}}
        @if(Auth::user()->roletype !== 'pegawai')
            <div id="o1" class="content">
                <h3 id="sm">Surat Masuk<p>{{ $jumlahSuratMasuk }}</p><img src="{{ asset('images/SM.png') }}" alt="Surat Masuk" style="position: absolute; top: 10px; right: 20px; width: 30%; height: auto;"></h3>
                <h3 id="bd">Belum Disposisi<p>{{ $belumDisposisi }}</p><img src="{{ asset('images/5.png') }}" alt="Belum Disposisi" style="position: absolute; top: 20px; right: 20px; width: 25%; height: auto;"></h3>
                <h3 id="btl">Belum Ditindak<p>{{ $belumTindakLanjut }}</p><img src="{{ asset('images/3.png') }}" alt="Belum Ditindak" style="position: absolute; top: 5px; right: 20px; width: 30%; height: auto;"></h3>
                <h3 id="sd">Terlaksana<p>{{ $selesai }}</p><img src="{{ asset('images/4.png') }}" alt="Terlaksana" style="position: absolute; bottom: 13px; right: 20px; width: 40%; height: auto;"></h3>
            </div>
        @endif
        <div id="o2" class="content">
            {{-- Sosmed/kontak --}}
            <h3 style="font-weight: bold; position: absolute; left: 30%;">Hubungi Kami</h3>
            @if(Auth::user()->roletype == 'pegawai')
                <div id="contact-box">
                    <a href="https://www.instagram.com/bpskaboganilir?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" id="app-icon" target="_blank">
                        <img src="{{ asset('images/ig.png') }}" alt="Instagram" style="position: absolute; bottom: 55%; left: 17%; width: 75px; height: 75px;">
                        <span style="position: absolute; bottom: 51%; left: 16.7%;">Instagram</span>
                    </a>
                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to=bps.1610@gmail.com" target="_blank" id="app-icon">
                        <img src="{{ asset('images/gmail.png') }}" alt="Email" style=" position: absolute; bottom: 55%; left: 27%; width: 75px; height: 75px;">
                        <span style="position: absolute; bottom: 51%; left: 28%;">Email</span>
                    </a>
                    <a href="https://oganilirkab.bps.go.id/id" class="app-icon" target="_blank">
                        <img src="{{ asset('images/web.png') }}" alt="Website" style="position: absolute; bottom: 55%; left: 47%; width: 75px; height: 75px;">
                        <span style="position: absolute; bottom: 51%; left: 47.2%;">Website</span>
                    </a>
                    <a href="https://wa.me/6281358221706" class="app-icon" target="_blank">
                        <img src="{{ asset('images/wa.png') }}" alt="WhatsApp" style="position: absolute; bottom: 55%; left: 37%; width: 75px; height: 75px;">
                        <span style="position: absolute; bottom: 51%; left: 36.6%;">WhatsApp</span>
                    </a>
                </div>
            @else
            <div id="contact-box">
                <a href="https://www.instagram.com/bpskaboganilir?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" id="app-icon" target="_blank">
                    <img src="{{ asset('images/ig.png') }}" alt="Instagram" style="position: absolute; bottom: 35%; left: 17%; width: 75px; height: 75px;">
                    <span style="position: absolute; bottom: 31%; left: 16.7%;">Instagram</span>
                </a>
                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=bps.1610@gmail.com" target="_blank" id="app-icon">
                    <img src="{{ asset('images/gmail.png') }}" alt="Email" style=" position: absolute; bottom: 35%; left: 27%; width: 75px; height: 75px;">
                    <span style="position: absolute; bottom: 31%; left: 28%;">Email</span>
                </a>
                <a href="https://oganilirkab.bps.go.id/id" class="app-icon" target="_blank">
                    <img src="{{ asset('images/web.png') }}" alt="Website" style="position: absolute; bottom: 35%; left: 47%; width: 75px; height: 75px;">
                    <span style="position: absolute; bottom: 31%; left: 47.2%;">Website</span>
                </a>
                <a href="https://wa.me/6281358221706" class="app-icon" target="_blank">
                    <img src="{{ asset('images/wa.png') }}" alt="WhatsApp" style="position: absolute; bottom: 35%; left: 37%; width: 75px; height: 75px;">
                    <span style="position: absolute; bottom: 31%; left: 36.6%;">WhatsApp</span>
                </a>
            </div>
            @endif
            {{-- kalender --}}
            <div id="calendar"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            //kalender
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id',
            });

            calendar.render();

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