<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionsM extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $fillable = ['id', 'nomor_unik', 'nama_pelanggan', 'id_produk','est_selesai', 
                            'uang_bayar','uang_kembali','pembayaran','status_pengerjaan'];

    public function products()
    {
        return $this->belongsTo(ProductsM::class, 'id_produk');
    }
}
