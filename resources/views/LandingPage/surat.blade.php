<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Pendaftaran</title>
    <style>
       html, body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Times New Roman", Times, serif;
        font-size: 12pt;
        line-height: 1.5;
    }

    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 0mm 10mm 10mm 10mm; /* 1cm semua sisi */
        margin: auto;
        background: white;
         overflow: hidden;
         transform: scale(0.95); 
        box-sizing: border-box;
        position: relative;
    }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header img {
            height: 80px;
        }

        .kop {
            text-align: center;
            line-height: 1.4;
            flex: 1;
        }

        .kop h3 {
            margin: 0;
            font-size: 16pt;
        }

        hr {
            border: 1.5px solid black;
            margin: 10px 0 20px;
        }

        .title {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            margin: 10px 0 20px;
            font-size: 14pt;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 4px 8px;
            vertical-align: top;
        }

        .info-table td:first-child {
            width: 200px;
        }

        .foto-ktm {
            width: 120px;
            height: 160px;
            object-fit: cover;
            border: 1px solid #000;
        }

        .footer {
            margin-top: 50px;
            width: 100%;
        }

        .footer td {
            vertical-align: top;
            text-align: right;
        }

        .btn-group {
            margin: 20px 0;
            text-align: center;
        }

        .btn-group button {
            padding: 8px 16px;
            margin-right: 10px;
            font-size: 14px;
            cursor: pointer;
        }

        .timestamp {
            font-size: 10pt;
            margin-bottom: 10px;
        }

        @media print {
            .btn-group {
                display: none !important;
            }
            .info-banner {
                display: none !important;
            }
        }
    </style>
</head>
<body>

@if(session('info'))
<div class="info-banner" style="max-width: 210mm; margin: 10px auto; padding: 12px 16px; background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 8px; color: #1e40af; font-size: 13px;">
    {{ session('info') }}
</div>
@endif

<div class="page" id="print-area">
    <div class="timestamp">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d/m/Y') }}
    </div>

    <div class="header">
        <img src="{{ asset('img/logo_poli.png') }}" alt="Logo Kiri">
        <div class="kop">
            <h3>POLITEKNIK NEGERI JEMBER</h3>
            KELUARGA MAHASISWA<br>
            <strong>UNIT KEGIATAN MAHASISWA</strong><br>
            <strong>KORPS SUKARELA PALANG MERAH INDONESIA</strong><br>
            <small>Jalan Mastrip Kotak Pos 164 Jember 68121<br>
                Hp.0821-3965-8194 | Email: ukm.ksr@polije.ac.id</small>
        </div>
        <img src="{{ asset('img/Lambang.png') }}" alt="Logo Kanan">
    </div>

    <hr>

    <div class="title">BUKTI PENDAFTARAN ANGGOTA BARU</div>

    <table class="info-table">
        <tr>
            <td>No. Pendaftaran</td><td>: {{ $data->No_pendaftaran }}</td>
            <td rowspan="8" align="right">
                @if($data->foto)
                    <img src="{{ asset('storage/' . $data->foto) }}" class="foto-ktm">
                @endif
            </td>
        </tr>
        <tr><td>NIM</td><td>: {{ $data->nim }}</td></tr>
        <tr><td>Nama Lengkap</td><td>: {{ $data->Nama }}</td></tr>
        <tr><td>Nama Panggilan</td><td>: {{ $data->Nama_panggilan }}</td></tr>
        <tr><td>Tempat, Tanggal Lahir</td><td>: {{ $data->tempat_lahir }}, {{ \Carbon\Carbon::parse($data->tanggal_lahir)->translatedFormat('d M Y') }}</td></tr>
        <tr><td>Agama</td><td>: {{ $data->Agama }}</td></tr>
        <tr><td>Jurusan</td><td>: {{ $data->jurusan }}</td></tr>
        <tr><td>Program Studi</td><td>: {{ $data->prodi }}</td></tr>
        <tr><td>Alamat</td><td colspan="2">: {{ $data->alamat }}</td></tr>
        <tr><td>Email</td><td colspan="2">: {{ $data->email }}</td></tr>
        <tr><td>No. Telepon</td><td colspan="2">: {{ $data->No_tlpn }}</td></tr>
        <tr><td>Golongan Darah</td><td colspan="2">: {{ $data->Gol_darah }}</td></tr>
        <tr><td>Jenis Kelamin</td><td colspan="2">: {{ ucfirst($data->jenis_kelamin) }}</td></tr>
        <tr><td>Organisasi yang Pernah Diikuti</td><td colspan="2">: {{ $data->organisasi_yg_pernah_diikuti ?? '-' }}</td></tr>
        <tr><td>Alasan Bergabung</td><td colspan="2">: {{ $data->alasan_join }}</td></tr>
    </table>
    <table class="footer">
        <tr>
            <td>
                Jember, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>
                Pendaftar<br><br>
                <strong>{{ $data->Nama }}</strong><br>
                NIM {{ $data->nim }}
            </td>
        </tr>
    </table>
</div>

{{-- Tombol --}}
<div class="btn-group">
    <button onclick="window.print()">Cetak Halaman</button>
    
</div>

{{-- html2pdf --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
    function downloadPDF() {
        const element = document.getElementById('print-area');
       const opt = {
    margin: [0, 10, 10, 10], // margin 1cm di PDF (atas, kiri, bawah, kanan)
    filename: 'bukti-pendaftaran-{{ $data->nim }}.pdf',
    image: { type: 'jpeg', quality: 0.98 },
    html2canvas: {
        scale: 2,
        useCORS: true,
        scrollY: 0
    },
    jsPDF: {
        unit: 'mm',
        format: 'a4',
        orientation: 'portrait'
    },
    pagebreak: { avoid: 'tr' } // opsional: hindari pecah tabel
};
</script>

</body>
</html>
