<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hasil Pemira Musang HMTI 2024</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        body{
            background-image: url('/assets/images/decorations/background.png');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body>
    <div class="text-center flex flex-row justify-between absolute w-full">
        <img src="\assets\images\decorations\atas-kiri.png" alt="">
        <div class="flex flex-col pt-[52px]">
            <h1 class="poppins-bold text-[58px] bg-clip-text text-transparent bg-gradient-to-b from-[#462814] via-[#956037] to-[#462814] leading-[87px]">SELAMAT KEPADA</h1>
        </div>
        <img src="\assets\images\decorations\atas-kanan.png" alt="">
    </div>    
    <div class="flex flex-row justify-center mx-[200px] pt-44">
        <div class="poppins-bold flex flex-col justify-center text-center items-center text-3xl bg-clip-text text-transparent bg-gradient-to-b from-[#462814] via-[#956037] to-[#462814] leading-tight px-12 py-6">
            <img src="\assets\images\calon\kandidat-1.png" alt="" width="354" height="371">
            <p class="pt-1">{{ $kandidatTertinggi->suara }} suara</p>
            <p class="pt-1">{{ $kandidatTertinggi->name }}</p>
            <p class="w-3/4 pt-10 text-[#462814]">Selamat dan sukses kepada 
                <span class="text-[#956037]">
                    Ketua HMTI Tahun 2025 
                </span> 
                yang terpilih untuk memimpin HMTI selama 1 tahun kedepan!</p>
        </div>
    </div>
    <footer>
        <img src="\assets\images\decorations\footer.png" alt="" class="w-full">
    </footer>
</body>
</html>