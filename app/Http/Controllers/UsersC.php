<?php

namespace App\Http\Controllers;

use App\Models\LogM;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $subtitle = "Daftar Pengguna";
    //    $usersM = User :: all();
      
       $usersM = User::all();
       return view('users', compact( 'subtitle', 'usersM'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subtitle = "Daftar users";
        return view('users_create', compact('subtitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'=> 'required',
            'username'=> 'required',
            'password'=> 'required',
            'password_confirm'=> 'required',
            'role'=> 'required',
        ]);
 
       User::create([
        'nama' => $request->input('nama'),
        'username' => $request->input('username'),
        'password' => Hash::make($request->input('password')),
        'role' => $request->input('role'),
       ]);

        return redirect()->route('users.index')->with('success', 'Users Berhasil Ditambahkan');
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
        $subtitle = "Edit User";
        $data = User::find($id);
        return view('users_edit', compact('subtitle', 'data'));
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
            'activity' => 'mengedit user'
        ]);

        $request->validate([
            'nama'=> 'required',
            'username'=> 'required',
            'role'=> 'required',
        ]);

        $data = request()->except(['_token', '_method', 'submit']);

        User::where('id',$id)->update($data);
    
        return redirect()->route('users.index')->with('success', 'Users berhasil di Perbaharui !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id',$id)->delete();
        
       $LogM = LogM::create([
           'id_user' => Auth::user()->id,
           'activity' => 'user menghapus users'
       ]);
      
       return redirect()->route('users.index')->with('success', 'Users Berhasil Dihapus');
   }

   public function changepassword($id)
   {
       $subtitle = "Edit Kata Sandi";
       $data = User::find($id);
       return view('change_password', compact('subtitle', 'data'));
   }

   public function change(Request $request, $id)
   {
       $LogM = LogM::create([
           'id_user' => Auth::user()->id,
           'activity' => 'user menganti password'
       ]);
       $request->validate([
           'password_new' => 'required',
           'password_confirm' => 'required|same:password_new',
           
       ]);
       $users = User::where("id", $id)->first();
       $users->update([
           'password' => Hash::make($request->password_new),
       
       ]);
       return redirect()->route('users.index')->with('success', 'Kata Sandi berhasil diperbaharui !');

}

}

