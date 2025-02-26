<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratMasuk;

class KepalaController extends Controller
{
    public function index(){
        $jumlahSuratMasuk = SuratMasuk::count();
        $belumDisposisi = SuratMasuk::where('Status', 'Belum Disposisi')->count();
        $belumTindakLanjut = SuratMasuk::where('Status', 'Belum di tindak lanjuti')->count();
        $selesai = SuratMasuk::where('Status', 'Selesai')->count();
        
        return view('website.admin.dashboard',  compact('jumlahSuratMasuk','belumDisposisi', 'belumTindakLanjut','selesai'));
    }
}
