<?php

namespace App\Http\Controllers;

use App\Models\LogM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogC extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $subtitle = "Daftar Activity";
        $vcari = $request->input('search');

        if ($vcari) {
            
        $logM = LogM::select('users.nama', 'users.username', 'users.role','log.activity', 'log.created_at')
        ->join('users', 'users.id', '=', 'log.id_user')
        ->where('nama', 'like', '%' . $vcari . '%')
        ->orwhere('username', 'like', '%' . $vcari . '%')
        ->orwhere('role', 'like', '%' . $vcari . '%') 
        ->orwhere('activity', 'like', '%' . $vcari . '%')
        ->orwhere('log.created_at', 'like', '%' . $vcari . '%');
        } else {
              
        $logM = LogM::select('users.nama', 'users.username', 'users.role','log.activity', 'log.created_at')
        ->join('users', 'users.id', '=', 'log.id_user')
        ->orderBy('log.id', 'desc');
        }
        // $logM = LogM::select('users.nama', 'users.username', 'users.role','log.activity', 'log.created_at')
            // ->join('users', 'users.id', '=', 'log.id_user')
            // ->orderBy('log.id', 'desc');
    
            if ($user->role == 'owner') {
                $logM = $logM->whereIn('users.role', ['kasir', 'owner', 'admin'])->get();
            } elseif ($user->role == 'kasir') {
                $logM = $logM->where('users.role', 'kasir')->where('users.id', $user->id)->get();
            } elseif ($user->role == 'owner') {
                $logM = $logM->whereIn('users.role', ['kasir', 'owner'])->where('users.id', $user->id)->SimplePaginate(5);
            } else {
                // Handle other roles if needed
            }            

            $vcari = request('search');
            return view('log', compact('subtitle', 'logM', 'vcari'));
}
}
