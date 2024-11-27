<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Pemira Musang HMTI 2024</title>
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
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-3">
                        SUARA
                    </th>
                    <th scope="col" class="px-6 py-3">
                        TAMBAH
                    </th>
                    <th scope="col" class="px-6 py-3">
                        KURANG
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kandidats as $kandidat)
                <tr id="kandidat-{{ $kandidat->id }}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $kandidat->name }}
                    </th>
                    <td class="px-6 py-4">
                        <span class="suara">{{ $kandidat->suara }}</span>  <!-- Tambahkan span untuk menampilkan jumlah suara -->
                    </td>
                    <td class="px-6 py-4">
                        <button class="tambah-suara border border-[#462814] w-10 rounded-full" data-id="{{ $kandidat->id }}">+</button>
                    </td>
                    <td class="px-6 py-4">
                        <button class="kurang-suara border border-[#462814] w-10 rounded-full" data-id="{{ $kandidat->id }}">-</button>
                    </td>
                </tr>                
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '.tambah-suara', function() {
            const kandidatId = $(this).data('id');
            const suaraSpan = $(`#kandidat-${kandidatId} .suara`);
            console.log("Tambah");
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