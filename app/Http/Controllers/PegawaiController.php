<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index(){
        $jumlahSuratMasuk = SuratMasuk::count(); 
        $belumDisposisi = SuratMasuk::where('Status', 'Belum Disposisi')->count();
        $belumTindakLanjut = SuratMasuk::where('Status', 'Belum di tindak lanjuti')->count();
        $selesai = SuratMasuk::where('Status', 'Selesai')->count();
        
        return view('website.admin.dashboard',  compact('jumlahSuratMasuk','belumDisposisi', 'belumTindakLanjut','selesai'));
    }
}
