<!DOCTYPE html>
<html>

  @php
  $numberOfDays = 7; // Change this value to the number of days you want to add
  $estSelesaiDate = \Carbon\Carbon::parse($transactions->est_selesai)->addDays($numberOfDays)->format('d/m/Y H:i:s');
@endphp

<head>
    <title>Struk Transaksi {{ $transactions->id_trans }}</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 500px;
            margin: 0 auto;
            padding: 10px;
        }
        .header {
            text-align: center;
        }
        .content {
            margin-top: 20px;
            font-size: 14px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
        }
        .barcode {
            text-align: right;
            margin-top: 20px;
        }
        .divider {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2 style="font-size: 25px;">STYCLEAN'Y</h2>
            <p style="font-size: 18px;">42, Hangang-daero, Yongsan-gu, Seoul.</p>
        </div>
        <div class="content">
            <div class="divider"></div>
            <p style="font-size: 17px;">Struk Transaksi StyCLean'y</p>
            <p style="font-size: 17px;">Tanggal: {{ \Carbon\Carbon::parse()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</p>
            <p style="font-size: 17px;">No Unik: <span class="p">{{ $transactions->nomor_unik }}</span>
            <div class="divider"></div>

            <p style="font-size: 17px;">Nama Pelanggan: <span class="p">{{ $transactions->nama_pelanggan }}</span>
            <p style="font-size: 17px;">Status Bayar: <span class="p">{{ $transactions->pembayaran }}</span>
              <p style="font-size: 17px;">Perkiraan Selesai: 
                <span class="p">{{ \Carbon\Carbon::parse($transactions->est_selesai)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</span>
            </p>
            <div class="divider"></div>
        </div>
        <div class="barcode">
            <p>Total: Rp.{{ number_format($transactions->products->harga_produk) }}</p>
            <p>Uang Bayar: Rp.{{ number_format($transactions->uang_bayar) }}</p>
            <p>Uang Kembali: Rp.{{ number_format($transactions->uang_kembali) }}</p>
        </div>
        <div class="footer">
            <div class="divider"></div>
            <p style="font-size: 17px;">Terima Kasih~~ Telah hadir di StyClean'y</p>
            <p style="font-size: 16px;">Bersihkan Pakaianmu di StyClean'y aja ya!~~</p>
        </div>
    </div>
</body>
</html>