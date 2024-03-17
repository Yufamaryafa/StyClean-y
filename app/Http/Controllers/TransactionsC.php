<?php

namespace App\Http\Controllers;

use App\Models\LogM;
use App\Models\ProductsM;
use App\Models\TransactionsM;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Auth;

class TransactionsC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $LogM = LogM::create([
        'id_user' => Auth::user()->id,
        'activity' => 'Melihat Transaksi'
    ]);

    $subtitle = "Daftar Transaksi";
    $vcari = $request->input('search');
    $products = ProductsM:: all();
    // Menerapkan pencarian jika ada kata kunci pencarian
    if ($vcari) {
        $transactionsM = TransactionsM::with('products')
            ->where('nama_pelanggan', 'like', '%' . $vcari . '%')
            // ... sisa query
            ->get();
    } else {
        $transactionsM = TransactionsM::with('products')->get();
    }

    return view('transactions', compact('transactionsM', 'subtitle', 'vcari','products'));
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subtitle = "Transaksi Create";
        $pM = ProductsM:: all();
        return view('transactions_create', compact('pM', 'subtitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'Menambahkan Transaksi'
        ]);

        $request->validate([
            'nomor_unik' => 'required|numeric',
            'nama_pelanggan' => 'required',          
            'id_produk' => 'required',
            'uang_bayar' => 'required|numeric',
            'status_pengerjaan' => 'required',
            'est_selesai' => 'required|date',
            'pembayaran' => 'required',
        ]);
    
        // Find the selected product
        $product = ProductsM::where("id", $request->input('id_produk'))->first();
    
        if (!$product) {
            // Handle the case where the selected product is not found.
            return redirect()->back()->with('error', 'Product not found.');
        }
      
        $harga_produk = $product->harga_produk;
        $uang_bayar = $request->uang_bayar;
        $uang_kembali = $uang_bayar - $harga_produk;
    
        TransactionsM::create([
            'nomor_unik' => $request->nomor_unik,
            'nama_pelanggan' => $request->nama_pelanggan,
            'id_produk' => $request->id_produk,
            'est_selesai' => $request->est_selesai,
            'uang_bayar' => $uang_bayar,
            'uang_kembali' => $uang_kembali,
            'pembayaran' => $request->pembayaran,
            'status_pengerjaan' => $request->status_pengerjaan,
        ]);
    
        return redirect()->route('transactions.index')->with('success', 'Transaksi Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subtitle = "Daftar Edit Transaksi";
        $transactions = TransactionsM::find($id);

        $productsM = ProductsM::all();
        return view('transactions_edit', compact('transactions', 'productsM', 'subtitle'));       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'Update Transaksi'
        ]);

        $products = ProductsM::where("id", $request->input('id_produk'))->first();
        $request->validate([
            'nomor_unik' => 'required|numeric',
            'nama_pelanggan' => 'required',          
            'id_produk' => 'required',
            'uang_bayar' => 'required|numeric',
            'status_pengerjaan' => 'required',
            'est_selesai' => 'required|date',
            'pembayaran' => 'required',
        ]);

        $transactions = TransactionsM::find($id);
        $transactions->nomor_unik = $request->input('nomor_unik');
        $transactions->nama_pelanggan = $request->input('nama_pelanggan');
        $transactions->id_produk = $request->input('id_produk');
        $transactions->uang_bayar = $request->input('uang_bayar');
        $transactions->pembayaran = $request->input('pembayaran');
        $transactions->status_pengerjaan = $request->input('status_pengerjaan');
        $transactions->est_selesai = $request->input('est_selesai');
        $transactions->uang_kembali = $request->input('uang_bayar') - $products->harga_produk;
        $transactions->save();

        return redirect()->route('transactions.index')->with('success', 'Data Transactions Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'Menghapus Transaksi'
        ]);
        
        TransactionsM::where('id', $id)->delete();
        return redirect()->route('transactions.index')->with('success', 'Produk Berhasil Dihapus');
    }

    public function generateStruk($id)
{
    $transactions = TransactionsM::findOrFail($id);

    $pdf = PDF::loadView('transactions_struk', compact('transactions'));

    return $pdf->stream('struk-' . $transactions->nomor_unik . '.pdf');
}

// public function all()
// {
//     $subtitle = "tanggal";
//     $transactions=TransactionsM::all();
//     $products=ProductsM::all();

//     return view('transactions_date', compact('subtitle', 'transactions','products'));
// }

// public function pertanggal(Request $request)
// {
//     // Gunakan tanggal yang diterima sesuai kebutuhan
//     $tgl_awal = $request->input('tgl_awal');
//     $tgl_akhir = $request->input('tgl_akhir');

//     $transactions = TransactionsM::select(
//         'transactions.*', 
//         'products.nama_produk',  // Tambahkan kolom-kolom yang diperlukan dari tabel products
//         'products.harga_produk',
//         'products.min_berat',
//         'products.ket',
//         'transactions.id AS id_tran', 
//         'transactions.created_at AS tg'
//     )
//     ->join('products', 'products.id', '=', 'transactions.id_produk')
//     ->whereBetween('transactions.created_at', [$tgl_awal, $tgl_akhir])
//     ->get();

//     $pdf = PDF::loadview('transactions_pdf', compact('transactions'))->setPaper('a4', 'landscape');
//     return $pdf->stream('stgl.pdf');
// }
}
