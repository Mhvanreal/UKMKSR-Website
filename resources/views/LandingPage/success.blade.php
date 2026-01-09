
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Rekrutmen Anggota Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body class="flex flex-col min-h-screen bg-gray-100">

   <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="w-full max-w-md p-6 text-center bg-white rounded shadow">
            <h2 class="mb-4 text-lg font-bold">Pendaftaran Berhasil!</h2>
            <p class="mb-6">Silakan Cetak Pendaftaran Beserta Join Grup CA:</p>

            <div class="flex flex-col gap-3">
                <a href="{{ route('rekrutmen.cetak', ['No_pendaftaran' => $no_pendaftaran]) }}"
                    class="px-4 py-2 font-semibold text-white bg-blue-600 rounded hover:bg-blue-700">
                    Cetak Bukti Pendaftaran
                </a>

                <a href="{{ $wa_link }}" target="_blank"
                    class="px-4 py-2 font-semibold text-white bg-green-500 rounded hover:bg-green-600">
                    Gabung ke Grup WhatsApp
                </a>

            </div>
        </div>
    </div>

</body>
</html>
