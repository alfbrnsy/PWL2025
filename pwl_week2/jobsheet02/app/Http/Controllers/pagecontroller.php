<?php

namespace App\http\Controllers;
use Illuminate\Http\Request;

class pagecontroller extends Controller {
    
    public function index() {
        return 'Selamat Datang';
    }

    public function about()
    {
        return 'Nama = Aldo Febriansyah <br> NIM = 2341760146';
    }

    public function articles($id) 
    {
        return 'Halaman Artikel dengan ID'.$id;
    }
}