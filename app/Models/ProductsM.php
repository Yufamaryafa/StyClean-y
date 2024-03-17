<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsM extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['id','nama_produk', 'harga_produk','waktu','min_berat','ket'];

    public function transactions()
    {
        return $this->hasMany(TransactionsM::class, 'id_produk');
    }
}
