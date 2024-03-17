<?php

namespace App\Http\Controllers;

use App\Models\LogM;
use App\Models\ProductsM;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class ProductsC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'Melihat Produk'
        ]);

       $subtitle = "Daftar Produk";
       $productsM= ProductsM::all();
       return view('products', compact('productsM', 'subtitle'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subtitle = "Daftar Produk";
        return view('products_create', compact('subtitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $logM = LogM::create([
        'id_user' => Auth::user()->id,
        'activity' => 'Melakukan Proses Tambah Produk'
    ]);

    $request->validate([
        'nama_produk' => 'required',
        'harga_produk' => 'required',
        'waktu' => 'required', 
        'min_berat' => 'required', 
        'ket' => 'required',
    ]);

    ProductsM::create($request->post());

    return redirect()->route('products.index')->with('success', 'Data Products Berhasil Ditambahkan');
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
        $subtitle = "Daftar Edit";
        $products = ProductsM::find($id);
        return view ('products_edit', compact('products','subtitle'));
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
            'activity' => 'Mengedit Produk'
        ]);

        $request->validate([
            'nama_produk'=> 'required',
            'harga_produk'=> 'required',
            'waktu'=> 'required', 
            'min_berat'=> 'required', 
            'ket'=> 'required', 
           
        ]);

        $products = request()->except(['_token', '_method', 'submit']);

        ProductsM::where('id',$id)->update($products);
        return redirect()->route('products.index')->with('success', 'Produk Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductsM::where('id',$id)->delete();
        return redirect()->route('products.index')->with('success', 'Produk Berhasil Dihapus');

        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'Menghapus Produk' ]);
    }

    public function pdf(Request $request)
    {
        $productsM = ProductsM::all(); // Mengambil semua data produk
    
        $pdf = PDF::loadView('products_pdf', compact('productsM'))->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

}
