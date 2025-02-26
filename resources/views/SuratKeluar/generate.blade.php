<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BPS Ogan Ilir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/form_style.css') }}">

  </head>
  <body>
    <div class="background-blur">
    <div class="container">
        <h3>Generate Surat</h3>
        <form action="{{ route('website.surat_keluar.generate') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Sifat:</label>
                <select name="sifat" id="sifat" class="form-control" required onchange="updateNomor1()">
                    <option value="" disabled selected>Pilih jenis surat</option>
                    <option value="Biasa">Biasa</option>
                    <option value="Rahasia">Rahasia</option>
                    <option value="Sangat Rahasia">Sangat Rahasia</option>
                    <option value="Terbatas">Terbatas</option>
                </select>
            </div>
            
            <div class="row">
                <div class="col-md-3">
                    <label>Nomor 1:</label>
                    <input type="text" id="nomor1" name="nomor1" class="form-control" readonly required>
                </div>
                <div class="col-md-3">
                    <label>Nomor 2:</label>
                    <input type="text" id="nomor2" name="nomor2" class="form-control" readonly required>
                </div>
                <div class="col-md-3">
                    <label>Nomor 3:</label>
                    <input type="text" name="nomor3" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label>Nomor 4:</label>
                    <input type="text" name="nomor4" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label>Tempat:</label>
                <input type="text" name="tempat" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Tanggal:</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Lampiran:</label>
                <select name="lampiranSelect" id="lampiranSelect" class="form-control" required onchange="toggleLampiran()">
                    <option value="" disabled selected>Pilih</option>
                    <option value="-">Tidak Ada Lampiran</option>
                    <option value="dengan">Dengan Lampiran</option>
                </select>
                <input type="text" name="lampiran" id="lampiranInput" class="form-control mt-2 d-none" placeholder="Masukkan isi lampiran">
            </div>
            <div class="form-group">
                <label>Hal:</label>
                <input type="text" name="hal" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Tujuan:</label>
                <input type="text" name="tujuan" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Isi:</label>
                <textarea name="isi" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label>Pengirim:</label>
                <input type="text" name="pengirim" class="form-control" value="{{ auth()->user()->name }}" readonly required>
            </div>
            <div class="form-group">
                <label>Jabatan:</label>
                <input type="text" name="jabatan" class="form-control" value="{{ auth()->user()->jabatan }}" readonly required>
            </div>
            <div class="form-group">
                <label>NIP:</label><small class="text-muted">(Masukkan angka)</small>
                <input type="text" name="nip" class="form-control" required>
            </div>
            <div style="margin-top: 20px;">
            <button type="submit" class="btn btn-primary">Generate Surat</button>
            <button type="button" class="btn btn-primary" onclick="window.history.back()">Kembali</button>
            </div>
        </form>
    </div>
    </div>

    <script>
        //nomor1
        function updateNomor1() {
            let sifat = document.getElementById("sifat").value;
            let nomor1Field = document.getElementById("nomor1");
    
            let nomorMap = {
                "Biasa": "B",
                "Rahasia": "R",
                "Sangat Rahasia": "SR",
                "Terbatas": "T"
            };
    
            nomor1Field.value = nomorMap[sifat] || "";
        }

        //nomor2
        function generateNomor2() {
            let nomor2Field = document.getElementById("nomor2");
            
            fetch("{{ route('website.surat_keluar.getLastNumber') }}") 
                .then(response => response.json())
                .then(data => {
                    let lastNumber = data.last_number || 0;
                    let newNumber = String(lastNumber + 1).padStart(3, '0');
                    nomor2Field.value = newNumber;
                })
                .catch(error => console.error("Error fetching last number:", error));
        }

        window.onload = function() {
            generateNomor2();
        };
    </script>

    <script>
        nomor3
        let kodeKlasifikasi = {};

        fetch('/templates/kodeKlasifikasi.json')
            .then(response => response.json())
            .then(data => {
                kodeKlasifikasi = data;
                console.log("Kode Klasifikasi Loaded:", kodeKlasifikasi);
            })
            .catch(error => console.error('Error fetching JSON:', error));

        document.addEventListener("DOMContentLoaded", function() {
            const nomor3Input = document.querySelector("input[name='nomor3']");
            const tujuanInput = document.querySelector("input[name='tujuan']");

            tujuanInput.addEventListener("input", function() {
                const tujuanValue = tujuanInput.value.trim().toLowerCase();

                let kodeDitemukan = "";
                for (const key in kodeKlasifikasi) {
                    if (kodeKlasifikasi[key].nama.toLowerCase().includes(tujuanValue)) {
                        kodeDitemukan = kodeKlasifikasi[key].kode;
                        break;
                    }
                }

                nomor3Input.value = kodeDitemukan || "";
            });
        });
    </script>

    <script>
        //nomor4
        document.addEventListener("DOMContentLoaded", function() {
            let nomor4Field = document.querySelector("input[name='nomor4']");
            let tahunSekarang = new Date().getFullYear();
            nomor4Field.value = tahunSekarang;
        });
    </script>

<script>
    //lampiran
    function toggleLampiran() {
        let lampiranSelect = document.getElementById("lampiranSelect");
        let lampiranInput = document.getElementById("lampiranInput");

        if (lampiranSelect.value === "dengan") {
            lampiranInput.classList.remove("d-none");
            lampiranInput.setAttribute("required", "required");
            lampiranInput.value = "";
        } else {
            lampiranInput.classList.add("d-none");
            lampiranInput.removeAttribute("required");
            lampiranInput.value = "-"; 
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("lampiranInput").value = "-";
    });
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>