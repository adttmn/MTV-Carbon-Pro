<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    //
    public function berandaBackend()
    {
        return view('backend.v_beranda.index', [
            'judul' => 'Beranda',
            'sub' => 'Halaman Beranda'
        ]);
    }

    public function index()
    {
        $produk = Produk::where('status', 1)->orderBy('updated_at', 'desc')->paginate(6);
        return view('v_beranda.index', [
            'judul' => 'Halan Beranda',
            'produk' => $produk,
        ]);
    }
}
