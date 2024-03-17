<!DOCTYPE html>
<html>
<head>
  <title>Laporan Transaksi</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    .letterhead {
      background-color: #333;
      color: #fff;
      padding: 20px;
      text-align: center;
    }
    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
    }
    table, th, td {
      border: 1px solid #333;
    }
    th, td {
      padding: 10px;
      text-align: left;
    }
    th {
      background-color: #555;
      color: #fff;
    }
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    h1 {
      font-size: 24px;
      margin: 0;
    }
  </style>
</head>
<body>
  <div class="letterhead">
    <h1>Laporan Transaksi</h1>
    <p>{{ \Carbon\Carbon::parse()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</p>
  </div>
  <p>Yongsan-gu, Seoul.</p>
  <p>Kepada: CEO STYCLEAN'Y</p>
  <p>Hal: Laporan Transaksi</p>
  <div class="content">
    <p>Dengan Hormat,</p>
    <p>
        Kami ingin menyampaikan laporan transaksi laundry.
        Adapun rincian transaksi laundry selama
        bulan tersebut adalah sebagai berikut:</p>
          <table>
            <thead>
              <tr>
                <th>No Unik</th>
                <th>Nama Pelanggan</th>
                <th>Paket</th>
                <th>Uang Bayar</th>
                <th>Uang Kembali</th>
                <th>Status Pembayaran</th>
                <th>Status Pengerjaan</th>
                <th>Tanggal</th>
              </tr>
            </thead>
            <tbody>
              @php
                $totalHarga = 0;  
              @endphp
              @foreach ($transactionsM as $peserta)
              <tr>
                <td>{{ $peserta->nomor_unik }}</td>
                <td>{{ $peserta->nama_pelanggan }}</td>
                <td>{{ $peserta->products->nama_produk }} - {{ $peserta->products->harga_produk }} - {{ $peserta->products->harga_produk }} - {{ $peserta->products->min_berat}} - {{ $peserta->products->ket }} </td>
                <td>{{ $peserta->uang_bayar }}</td>
                <td>{{ $peserta->uang_kembali }}</td>
                <td>{{ $peserta->pembayaran }}</td>
                <td>{{ $peserta->status_pengerjaan }}</td>
                <td>{{ \Carbon\Carbon::parse($peserta->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY')}}</td>
              </tr>
              @php
                $totalHarga += $peserta->harga_produk; 
              @endphp
              @endforeach
            </tbody>
          </table>
       <p class="total">Total Pemasukan: Rp {{number_format($totalHarga, 0, ',', '.')}}</p>
  </div>
  </div>
    <div style="text-align: center;">
    <p>STYCLEAN'Y</p>
    <br>
    <h4 style="margin-bottom: 5px;"><u>Yufa Maryafa, S.I.Kom</u></h4>
    <p  style="margin-top: 5px;">CEO STYCLEAN'Y</p>
    <br>
  </div>
  </div>
</body>
</html>
