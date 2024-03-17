<?php

namespace App\Http\Controllers;

use App\Models\ProductsM;
use App\Models\TransactionsM;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use GuzzleHttp\Client;

    class HomeC extends Controller
    {
        public function index(){

            // API KEY

            // $apikeys = '4ea00b274e8d812acf67b8b404f659db';
            // $city = 'Bandung';
            // $url = 'https://api.openweathermap.org/data/2.5/weather?q=Subang&appid=5f9eb8db8224a5ee4f4e692a95d716f9';

            // $client = new Client([
            //     'verify' => false
            // ]);
            // $response = $client->get($url);
            // $data = json_decode($response->getBody(),true);
            // $temperature = $data ['main']['temp'];
            // $city = $data ['name'];
            // $negara = $data ['sys']['country'];

            $subtitle = "Dashboard";
            $today= Carbon::now();
            $transaksi = TransactionsM::all();
            $income = TransactionsM::join('products', 'transactions.id_produk', '=', 'products.id')
            ->sum('products.harga_produk');

        
            $products = ProductsM::count();
            $users = User::count();
            $formattedDate = $today->format('l, d F Y');

            return view('dashboard', compact('subtitle','formattedDate','transaksi','income','products','users',));
        }

    }
