<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Pendaftaran</title>
    <style>
        @page {
            size: A4;
            margin: 40px;
        }

        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            line-height: 1.5;
        }

        .header {
            text-align: center;
            position: relative;
            margin-bottom: 10px;
        }

        .logo-left {
            position: absolute;
            top: 10px;
            left: 40px;
            width: 70px;
        }

        .logo-right {
            position: absolute;
            top: 10px;
            right: 40px;
            width: 70px;
        }

        .kop {
            margin-top: 10px;
        }

        .title {
            text-align: center;
            font-weight: bold;
            margin: 20px 0 10px;
            text-decoration: underline;
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
            width: 180px;
        }

        .foto {
            width: 120px;
            height: 160px;
            object-fit: cover;
            border: 1px solid #333;
        }

        .timestamp {
            font-size: 10pt;
            margin-bottom: 10px;
        }

       .signature-wrapper {
        width: 100%;
        display: flex;
        justify-content: flex-end;
        margin-top: 50px;
    }

    .signature-content {
        text-align: left;
        font-family: "Times New Roman", Times, serif;
        font-size: 12pt;
        line-height: 1.6;
    }
        .logo-right {
        position: absolute;
        top: 10px;
        right: 40px;
        width: 100px;
        height: auto;
    }
    </style>
</head>
<body>

    <div class="timestamp">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}
    </div>

    {{-- Kop Surat --}}
        <table width="100%" style="margin-bottom: 10px;">
        <tr>
            <td width="20%" align="left">
                <img src="{{ public_path('img/logo_poli.png') }}" style="width: 90px;">
            </td>
            <td width="60%" align="center" style="line-height: 1.4;">
                <strong>POLITEKNIK NEGERI JEMBER</strong><br>
                KELUARGA MAHASISWA<br>
                <strong>UNIT KEGIATAN MAHASISWA</strong><br>
                <strong>KORPS SUKARELA PALANG MERAH INDONESIA</strong><br>
                <small>
                    Jalan Mastrip Kotak Pos 164 Jember 68121<br>
                    Hp.0821-3965-8194  | Email: ukm.ksr@polije.ac.id
                </small>
            </td>
            <td width="20%" align="right">
                <img src="{{ public_path('img/Lambang.png') }}" style="width: 90px;">
            </td>
        </tr>
    </table>
    <hr style="border: 1.5px solid black; margin: 0;">
    <div class="title">BUKTI PENDAFTARAN ANGGOTA BARU</div>
    <table class="info-table">
        <tr>
            <td>No. Pendaftaran</td><td>: {{ $data->No_pendaftaran }}</td>
            <td rowspan="8" align="right">
                @if($data->foto)
                    <img src="{{ public_path('storage/' . $data->foto) }}" class="foto">
                @endif
            </td>
        </tr>
        <tr><td>NIM</td><td>: {{ $data->nim }}</td></tr>
        <tr><td>Nama Lengkap</td><td>: {{ $data->Nama }}</td></tr>
        <tr><td>Nama Panggilan</td><td>: {{ $data->Nama_panggilan }}</td></tr>
        <tr><td>Tempat, Tanggal Lahir</td><td>: {{ $data->tempat_lahir }} , {{ \Carbon\Carbon::parse($data->tanggal_lahir)->translatedFormat('d M Y') }}</td></tr>
        <tr><td>Agama</td><td>: {{ $data->Agama }}</td></tr>
        <tr><td>Jurusan</td><td>: {{ $data->jurusan }}</td></tr>
        <tr><td>Program Studi</td><td>: {{ $data->prodi }}</td></tr>
        <tr><td>Alamat</td><td colspan="2">: {{ $data->alamat }}</td></tr>
        <tr><td>Email</td><td colspan="2">: {{ $data->email }}</td></tr>
        <tr><td>No. Telepon</td><td colspan="2">: {{ $data->No_tlpn }}</td></tr>
        <tr><td>Golongan Darah</td><td colspan="2">: {{ $data->Gol_darah }}</td></tr>
        <tr><td>Jenis Kelamin</td><td colspan="2">: {{ ucfirst($data->jenis_kelamin) }}</td></tr>
        <tr><td>Organisasi yang Pernah Diikuti</td><td colspan="2">: {{ $data->organisasi_yg_pernah_diikuti }}</td></tr>
        <tr><td>Alasan Bergabung</td><td colspan="2">: {{ $data->alasan_join }}</td></tr>
    </table>


   <table style="width: 100%; margin-top: 50px;">
    <tr>
        <td style="width: 90%;"></td>
        <td style="width: 40%; text-align: left;">
            Jember, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>
            Pendaftar<br><br><br><br>
            <strong>{{ $data->Nama }}</strong><br>
            NIM {{ $data->nim }}
        </td>
    </tr>
</table>



</body>
</html>
