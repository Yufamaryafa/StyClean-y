<!DOCTYPE html>
<html>
<head>
    <title>Laporan Products</title>
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
        <h1>Laporan Produk</h1>
        <p>{{ date('l, d F Y') }}</p>
      </div>
      <p>Yongsan-gu, Seoul.</p>
      <p>Kepada: CEO STYCLEAN'Y</p>
      <p>Hal: Laporan Produk</p>
      <div class="content">
        <p>Dengan Hormat,</p>
        <p>
            Kami ingin menyampaikan laporan Produk laundry.
            Adapun rincian transaksi laundry selama
            bulan tersebut adalah sebagai berikut:</p>
              <table>
                <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Berat Min(Kg)</th>
                <th>Waktu Pengerjaan</th>
                <th>Harga</th>
                <th>Keterangan Bahan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productsM as $produk)
            <tr>
                <td>{{ $produk->nama_produk }}</td>
                <td>{{ $produk->min_berat }}</td>
                <td>{{ $produk->waktu }}</td>
                <td>{{ $produk->harga_produk }}</td>
                <td>{{ $produk->ket }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="text-align: center;">
        <p>STYCLEAN'Y</p>
        <br>
        <h4 style="margin-bottom: 5px;"><u>Yufa Maryafa, S.I.Kom</u></h4>
        <p  style="margin-top: 5px;">CEO STYCLEAN'Y</p>
        <br>
      </div>
</body>
</html>
