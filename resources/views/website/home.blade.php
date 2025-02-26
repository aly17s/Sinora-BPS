<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINORA - LOGIN</title>
    <!-- Link ke CSS dari folder public -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Acme&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/LOGIN_style.css') }}">
</head>
<body>
    <div class="logo-container">
        <img src="{{ asset('images/BPS_logo.png') }}" alt="Company Logo" class="logo">
        <h1 class="company-name">Badan Pusat Statistik</h1>
    </div>

    <div class="background-blur"></div>

    <div class="login-container">
        <h1 class="app-name" style="color: #0093DD">SINO<span style="color: #000000">RA</span></h1>
        <p class="app-longname">(Sistem Informasi Penomoran Surat)</p>
        <form class="input-container" action="{{ route('login')}}" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <span class="forgot-password" onclick="openModal()">Lupa Password?</span>
    </div>

    <div id="forgotPasswordModal" class="modal">
        <div class="modal-content">
            <h3>Lupa Password</h3>
            <label for="nama">Masukkan Nama Anda</label>
            <input type="text" id="nama" class="input-field" placeholder="Nama Anda">

            <label for="nohp">Masukkan Nomor HP</label>
            <input type="tel" id="nohp" class="input-field" placeholder="Nomor HP">

            <button onclick="kirimPesan()" class="btn-kirim">Kirim</button>
            <button onclick="tutupModal()" class="btn-tutup">Tutup</button>
        </div>
    </div>


    {{-- <script>
        function openModal() {
            document.getElementById("forgotPasswordModal").style.display = "flex";
        }

        function closeModal() {
            document.getElementById("forgotPasswordModal").style.display = "none";
        }

        function submitForgotPassword() {
            let userName = document.getElementById("userName").value.trim();
            if (userName === "") {
                alert("Nama tidak boleh kosong!");
            } else {
                alert("Permintaan reset password dikirim untuk: " + userName);
                closeModal();
                // Redirect ke halaman reset password jika diperlukan
                window.location.href = "{{ route('password.request') }}";
            }
        }
    </script>

    <script>
        function kirimPesan() {
        var nama = document.getElementById("nama").value.trim();
        var nohp = document.getElementById("nohp").value.trim();
        
        if (nama === "" || nohp === "") {
            alert("Harap isi nama dan nomor HP terlebih dahulu!");
            return;
        }
        
        var nomorTujuan = "6281358221706"; // Ubah sesuai nomor tujuan
        var pesan = "User " + nama + " lupa password";
        
        // Encode pesan agar sesuai dengan URL
        var encodedPesan = encodeURIComponent(pesan);

        // Buat link WhatsApp
        var waLink = "https://wa.me/" + nomorTujuan + "?text=" + encodedPesan;

        // Arahkan pengguna ke WhatsApp
        window.open(waLink, "_blank");
    }

    </script> --}}
    
</body>
</html>