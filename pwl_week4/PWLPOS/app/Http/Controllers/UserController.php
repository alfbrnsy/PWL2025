<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        //tambah data user dengan Eloquent Model
      //  $data = [
            // 'username' => 'customer-1',
            // 'nama' => 'Pelanggan',
            // 'password' => Hash::make('12345'),
            // 'level_id' => 5

       //     'nama' => 'Pelanggan Pertama',
       // ];
        // UserModel::insert($data); // tambahkan data ke tabel m_user
      //  UserModel::where('username','customer-1')->update($data); // update data user

        //coba akses model UserModel

        //$data = [
       //     'level_id' => 2,
       //     'username' => 'manager_tiga',
        //    'nama' => 'Manager 3',
        //    'password' => Hash::make('12345')
       // ];
       // UserModel::create($data);

       // $user = UserModel::all(); // ambil semua data
       // return view('user', ['data' => $user]);

      //$user = UserModel::find(1);
      //return view ('user', ['data' => $user]);

       //$user = UserModel::firstWhere('level_id', 1);
      // return view('user', ['data' => $user]);

      //$user = UserModel::findOrFail(1);
      //return view('user', ['data' => $user]);

      //$user = UserModel::where('username', 'manager9')->firsOrFail();
     // return view('user', ['data' => $user]);

    
     
        // $users = UserModel::where('level_id', 2)->get(); // Ambil semua user dengan level_id = 2
        // $userCount = $users->count(); // Hitung jumlahnya
         
        // return view('user', ['users' => $users, 'userCount' => $userCount]);
      
      //  $user = UserModel::firstOrCreate([
       //  'username' => 'manager',
        //  'nama' => 'Manager',
     // ]);
      
      // return view('user', ['data' => $user]); // Sesuaikan dengan variabel yang benar
      
      // $user = UserModel::firstOrCreate(
      //   [
      //    'username' => 'manager22',
      //    'nama' => 'Manager Dua Dua',
      //    'password' => Hash::make('12345'),
      //    'level_id' => 2
      //    ],
      // );
      //    return view('user', ['data' => $user]);
      
      // $user = UserModel::firstOrNew(
      //   [
      //     'username' => 'manager',
      //     'nama' => 'Manager',
      //   ],
      // );

      // return view('user', ['data' => $user]);

      // $user = UserModel::firstOrNew(
      //   [
      //     'username' => 'manager33',
      //     'nama' => 'Manager Tiga Tiga',
      //     'password' => Hash::make('12345'),
      //     'level_id' => 2
      //   ],
      // );
      // $user->save();

      // return view('user', ['data' => $user]);

      // $user = UserModel::Create([
      //   'username' => 'manager5',
      //   'nama' => 'Manager55',
      //   'password' => Hash::make('12345'),
      //   'level_id' => 2,
      // ]);

      //    $user->username = 'manager56'; 
         
      //    $user->isDirty(); // true 
      //    $user->isDirty('username'); // true 
      //    $user->isDirty('nama'); // false 
      //    $user->isDirty(['nama', 'username']); // true 
     
      //    $user->isClean(); // false 
      //    $user->isClean('username'); // false 
      //    $user->isClean('nama'); // true 
      //    $user->isClean(['nama', 'username']); // false 
        
      //    $user->save(); 
        
      //    $user->isDirty(); // false 
      //    $user->isClean(); // true
      //    dd($user->isDirty());
      
        //   $user = UserModel::Create([
        //  'username' => 'manager11',
        //  'nama' => 'Manager11',
        //  'password' => Hash::make('12345'),
        //  'level_id' => 2,
        //   ]);

        // $user->username = 'manager12';
        // $user->save();

        // $user->wasChanged();
        // $user->wasChanged('username');
        // $user->wasChanged(['username', 'level_id']);
        // $user->wasChanged('nama');
        // dd($user->wasChanged(['nama', 'username']));

        $user = UserModel::all();
        return view('user', ['data' => $user]);
        }
        public function tambah()
        {
          return view('user_tambah');
        }

        public function tambah_simpan(Request $request)
        {
          UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
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
            $user->password = hash::make('$request->password');
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