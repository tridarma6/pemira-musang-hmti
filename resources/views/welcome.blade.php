<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pemira Musang HMTI 2024</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        body {
            background-image: url('/assets/images/decorations/background.png');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body>
    <div class="text-center flex flex-row justify-between absolute w-full z-0">
        <img src="\assets\images\decorations\atas-kiri.png" alt="" class="z-0">
        <div class="flex flex-col pt-6">
            <h1 class="poppins-bold text-[58px] bg-clip-text text-transparent bg-gradient-to-b from-[#462814] via-[#956037] to-[#462814] leading-tight">PENGHITUNGAN SUARA</h1>
            <h1 class="poppins-bold text-[48px] bg-clip-text text-transparent bg-gradient-to-b from-[#462814] via-[#956037] to-[#462814] leading-tight">PEMILU RAYA HMTI 2024</h1>
        </div>
        <img src="\assets\images\decorations\atas-kanan.png" alt="" class="z-0">
    </div>    
    <div class="flex flex-row justify-between mx-[200px] pt-44 z-10">
        <div class="grid grid-rows-2 grid-flow-col">
        @foreach ($kandidats as $kandidat)
            <div id="kandidat-{{ $kandidat->id }}" class="poppins-bold flex flex-col text-center items-center text-3xl bg-clip-text text-transparent bg-gradient-to-b from-[#462814] via-[#956037] to-[#462814] px-12 pt-6">
                <img src="{{ $kandidat->image }}" alt="" width="196" height="206">
                <div class="flex flex-row gap-6">
                    <button class="kurang-suara border border-[#462814] w-10 rounded-full" data-id="{{ $kandidat->id }}">-</button>
                    <p><span class="suara">{{ $kandidat->suara }}</span> Suara</p>
                    <button class="tambah-suara border border-[#462814] w-10 rounded-full" data-id="{{ $kandidat->id }}">+</button>
                    
                </div>
            </div>
        @endforeach
        </div>
        <div class="flex flex-col pt-10 items-center gap-8">
            <button id="start-button" class="mt-4 px-4 py-2 text-white rounded">
                <div id="video-stop" class="border-[4px] border-[#462814] rounded-[20px] w-[640px] h-[480px] flex justify-center text-center text-black py-52">
                    Tap untuk menghidupkan kamera
                </div>
                <video id="video" class="border-[4px] border-[#462814] rounded-[20px] w-[640px] h-[480px]" autoplay style="display: none;"></video>
            </button>
            <a href="/result" class="poppins-bold bg-[#956037] rounded-[22px] w-1/3 h-[65px] text-[24px] text-white border border-[#462814] text-center items-center pt-3 z-20">Lihat Hasil</a>
        </div>
    </div>
    <footer>
        <img src="\assets\images\decorations\footer.png" alt="" class="w-full">
    </footer>

    <script>
        const video = document.getElementById('video');
        const videoStop = document.getElementById('video-stop');
        let stream = null;
        let isCameraOn = false;

        // Fungsi untuk menghidupkan kamera
        async function startCamera() {
            try {
                stream = await navigator.mediaDevices.getUserMedia({ video: true });
                video.srcObject = stream;
                isCameraOn = true;
                videoStop.style.display = 'none';  // Sembunyikan tombol "Tap untuk menghidupkan kamera"
                video.style.display = 'block';  // Tampilkan elemen video
            } catch (error) {
                console.error('Gagal mengakses kamera:', error);
                alert('Gagal mengakses kamera. Pastikan izin kamera diberikan.');
            }
        }

        // Fungsi untuk mematikan kamera
        function stopCamera() {
            if (stream) {
                const tracks = stream.getTracks();
                tracks.forEach(track => track.stop());
                video.srcObject = null;
                isCameraOn = false;
                video.style.display = 'none';  // Sembunyikan elemen video
                videoStop.style.display = 'block';  // Tampilkan teks "Tap untuk menghidupkan kamera"
            }
        }

        // Fungsi toggle untuk menghidupkan/mematikan kamera saat tombol video-stop diklik
        videoStop.addEventListener('click', () => {
            if (!isCameraOn) {
                startCamera();
            }
        });

        // Fungsi untuk menghentikan kamera saat video diklik
        video.addEventListener('click', () => {
            if (isCameraOn) {
                stopCamera();
            }
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fungsi untuk mengambil data suara dari server
            function updateSuara() {
                $.ajax({
                    url: '/get-suara',  // Endpoint untuk mendapatkan suara
                    method: 'GET',  // Menggunakan metode GET untuk mengambil data
                    success: function(response) {
                        // Loop untuk setiap kandidat yang ada pada response
                        response.kandidats.forEach(function(kandidat) {
                            // Update elemen suara dengan data terbaru
                            const suaraSpan = $(`#kandidat-${kandidat.id} .suara`);
                            suaraSpan.text(kandidat.suara);  // Update suara di halaman
                        });
                    },
                    error: function() {
                        console.error('Gagal mengambil data suara');
                    }
                });
            }
            setInterval(updateSuara, 3000);
        });

        $(document).on('click', '.tambah-suara', function() {
            const kandidatId = $(this).data('id');
            const suaraSpan = $(`#kandidat-${kandidatId} .suara`);

            $.ajax({
                url: `/kandidat/${kandidatId}/tambah-suara`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}' // Laravel CSRF token
                },
                success: function(response) {
                    if (response.success) {
                        // Update jumlah suara di halaman
                        suaraSpan.text(response.kandidat.suara);
                    } else {
                        alert('Gagal menambahkan suara.');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan. Coba lagi.');
                }
            });
        });
        $(document).on('click', '.kurang-suara', function() {
            const kandidatId = $(this).data('id');
            const suaraSpan = $(`#kandidat-${kandidatId} .suara`);

            $.ajax({
                url: `/kandidat/${kandidatId}/kurang-suara`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}' // Laravel CSRF token
                },
                success: function(response) {
                    if (response.success) {
                        // Update jumlah suara di halaman
                        suaraSpan.text(response.kandidat.suara);
                    } else {
                        alert('Gagal mengurangkan suara.');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan. Coba lagi.');
                }
            });
        });
    </script>

</body>
</html>
