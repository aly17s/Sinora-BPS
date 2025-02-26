<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratMasuk;

class ArsipController extends Controller
{
    public function index()
    {
        $suratmasuks = SuratMasuk::where('Status', 'Selesai')->get();
        return view('website.SuratMasuk.arsip', compact('suratmasuks'));
    }
}
