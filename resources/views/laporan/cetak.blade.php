<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Laporan Pengaduan</title>
  <style>
    body {
      font-family: 'Times New Roman', Times, serif;
      font-size: 12px;
      margin: 0;
      padding: 0;
    }

    .container {
      width: 100%;
      padding: 0 10px;
    }

    .kop-table {
      width: 100%;
      border-bottom: 3px double black;
      margin-bottom: 20px;
    }

    .kop-table td {
      vertical-align: middle;
    }

    .logo-kiri {
      width: 80px;
      text-align: left;
    }

    .logo-kanan {
      width: 80px;
      text-align: right;
    }

    .kop-text {
      text-align: center;
      padding: 0 10px;
    }

    .kop-text h4 {
      margin: 0;
      font-size: 14px;
      color: #1a428a;
      letter-spacing: 1px;
    }

    .kop-text h2 {
      margin: 5px 0;
      font-size: 20px;
      font-weight: bold;
      text-transform: uppercase;
    }

    .kop-text h3 {
      margin: 0;
      font-size: 16px;
      font-weight: bold;
      text-transform: uppercase;
    }

    .kop-text p {
      margin: 5px 0 15px 0;
      font-size: 11px;
      font-style: italic;
    }

    .judul {
      text-align: center;
      margin-bottom: 20px;
    }

    .judul h3 {
      text-decoration: underline;
      margin-bottom: 5px;
      text-transform: uppercase;
    }

    .table-data {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    .table-data th,
    .table-data td {
      border: 1px solid black;
      padding: 6px;
      vertical-align: top;
    }

    .table-data th {
      background-color: #f2f2f2;
      font-weight: bold;
      text-align: center;
    }

    .text-success {
      color: green;
      font-weight: bold;
    }

    .text-warning {
      color: orange;
      font-weight: bold;
    }

    .text-secondary {
      color: gray;
      font-weight: bold;
    }

    .signature {
      width: 100%;
      margin-top: 50px;
    }

    .sign-box {
      float: right;
      width: 250px;
      text-align: center;
    }

    .clearfix::after {
      content: "";
      clear: both;
      display: table;
    }
  </style>
</head>

<body>

  <div class="container">
    <table class="kop-table">
      <tr>
        <td class="logo-kiri">
          @php
            $pathYayasan = public_path('images/LogoYayasan.png');
            // $pathYayasan = '/home/suarakam/public_html/images/LogoYayasan.png'; <-- untuk production
            $typeYayasan = pathinfo($pathYayasan, PATHINFO_EXTENSION);
            $dataYayasan = file_get_contents($pathYayasan);
            $base64Yayasan = 'data:image/' . $typeYayasan . ';base64,' . base64_encode($dataYayasan);
          @endphp
          <img src="{{ $base64Yayasan }}" width="80" alt="Logo Yayasan">
        </td>
        <td class="kop-text">
          <h4>YAYASAN SASMITA JAYA</h4>
          <h2>UNIVERSITAS PAMULANG</h2>
          <h3>FAKULTAS ILMU KOMPUTER</h3>
          <p>
            Jl. Surya Kencana No. 1, Pamulang, Tangerang Selatan, Banten<br>
            Website: www.suarakampus.web.id | Email: admin@unpam.ac.id
          </p>
        </td>
        <td class="logo-kanan">
          @php
            $pathUnpam = public_path('images/LogoUnpam.png');
            // $pathUnpam = '/home/suarakam/public_html/images/LogoUnpam.png'; <-- untuk production
            $typeUnpam = pathinfo($pathUnpam, PATHINFO_EXTENSION);
            $dataUnpam = file_get_contents($pathUnpam);
            $base64Unpam = 'data:image/' . $typeUnpam . ';base64,' . base64_encode($dataUnpam);
          @endphp
          <img src="{{ $base64Unpam }}" width="80" alt="Logo Unpam">
        </td>
      </tr>
    </table>

    <div class="judul">
      <h3>LAPORAN DATA PENGADUAN</h3>
      <span>
        Periode: {{ \Carbon\Carbon::parse($tglAwal)->translatedFormat('d F Y') }}
        s/d
        {{ \Carbon\Carbon::parse($tglAkhir)->translatedFormat('d F Y') }}
      </span>
    </div>

    <table class="table-data">
      <thead>
        <tr>
          <th width="5%">No</th>
          <th width="15%">Tanggal</th>
          <th width="20%">Pelapor</th>
          <th width="20%">Lokasi</th>
          <th>Deskripsi</th>
          <th width="10%">Status</th>
        </tr>
      </thead>
      <tbody>
        @forelse($pengaduans as $p)
          <tr>
            <td style="text-align: center;">{{ $loop->iteration }}</td>
            <td>
              {{ $p->created_at->format('d/m/Y') }}<br>
              <small>{{ $p->created_at->format('H:i') }} WIB</small>
            </td>
            <td>
              <strong>{{ $p->mahasiswa->nama ?? 'User Dihapus' }}</strong><br>
              <small>NIM: {{ $p->mahasiswa->nim ?? '-' }}</small>
            </td>
            <td>{{ $p->lokasi }}</td>
            <td>{{ $p->deskripsi }}</td>
            <td style="text-align: center;">
              @if($p->status == 'selesai')
                <span class="text-success">Selesai</span>
              @elseif($p->status == 'diproses')
                <span class="text-warning">Diproses</span>
              @else
                <span class="text-secondary">Diajukan</span>
              @endif
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" style="text-align: center; padding: 20px;">
              <i>Tidak ada data pengaduan.</i>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>

    <div class="signature clearfix">
      <div class="sign-box">
        <p>Tangerang Selatan, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <p style="margin-bottom: 60px;">Mengetahui,</p>

        <p style="text-decoration: underline; font-weight: bold;">
          {{ auth()->user()->name }}
        </p>
        <p>Administrator</p>
      </div>
    </div>
  </div>
</body>

</html>