<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\UserModel;


class UserController extends Controller
{
    public function index()
    {   
        //tambah data user dengan Eloquent Model
        // $data = [
        //          'level_id' => 2,  
        //          'username' => 'manager_tiga',
        //          'nama' => 'Manager 3   ',
        //          'password' => Hash::make('12345'),
                
        //     ];
        //     UserModel::create($data);

        // //coba akses model UserModel
        // $user = UserModel::all(); // ambil semua data dari tabel m_user

        $user = UserModel::all();
        return view('user', ['data' => $user]);

        $user = UserModel::with('level')->get();
        return view('user', ['data' => $user]);
    }

    public function tambah()
    {
        return view('user_tambah');
    }

    public function tambah_simpan(Request $request)
    {
        UserModel::create([
            'username' =>$request->username,
            'nama' =>$request->nama,
            'password' => Hash::make('$request->password'),
            'level_id' => $request->level_id
        ]);

        return redirect('/user');
    }

    public function ubah($id)
    {
        $user = UserModel::find($id);
        return view('user_ubah', ['data' => $user]);
    }

    public function ubah_simpan($id, Request $request)
    {
        $user = UserModel::find($id);

        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->password = Hash::make('$request->password');
        $user->level_id = $request->level_id;

        $user->save();
        
        return redirect('/user');
    }

    public function hapus($id)
    {
        $user = UserModel::find($id);
        $user->delete();

        return redirect('/user');
    }

}
