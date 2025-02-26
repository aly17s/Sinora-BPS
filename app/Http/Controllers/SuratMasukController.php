<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tindaklanjut;


class SuratMasukController extends Controller
{
    //index
    public function index(){
        $user = Auth::user(); 

        if ($user->roletype == 'pegawai') {
            $surat_masuks = SuratMasuk::where('Status', '!=', 'Selesai')
                ->whereJsonContains('tujuan', $user->name)
                ->get();
        }  else {
            $surat_masuks = SuratMasuk::where('Status', '!=', 'Selesai')->get();
        }
    
        return view('website.SuratMasuk.surat_masuk', data: compact('surat_masuks'));
    }

    //tambah surat
    public function create(){
        return view('suratmasuk.create');
    }
    public function input(Request $request){
        $validasi = $request->validate([
            'NoSurat' => 'required',
            'TanggalSurat' => 'required|date',
            'TanggalTerima' => 'required|date',
            'Dari' => 'required',
            'TingkatKeamanan' => 'required',
            'Status' => 'required',
            'Ringkasan' => 'required',
            'FileSurat' => 'required|file|mimes:pdf|max:4096',
            'FileLampiran' => 'nullable|file|mimes:pdf|max:4096'

        ]);

        // Upload File
        if (!$request->hasFile('FileSurat')) {
            return redirect()->back()->withErrors(['FileSurat' => 'File tidak ditemukan.']);
        }
    
        $file = $request->file('FileSurat');
        if ($file->isValid()) {
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/surat_masuk'), $filename);
            $validasi['FileSurat'] = $filename;
        } else {
            return redirect()->back()->withErrors(['FileSurat' => 'File tidak valid.']);
        }

        //lampiran
        if ($request->hasFile('FileLampiran')) {
            $fileLampiran = $request->file('FileLampiran');
            if ($fileLampiran->isValid()) {
                $filenameLampiran = time() . '_' . $fileLampiran->getClientOriginalName();
                $fileLampiran->move(public_path('uploads/surat_masuk'), $filenameLampiran);
                $validasi['FileLampiran'] = $filenameLampiran;
            } else {
                return redirect()->back()->withErrors(['FileLampiran' => 'File lampiran tidak valid.']);
            }
        } else {
            $validasi['FileLampiran'] = null;
        }
        

        SuratMasuk::create($validasi);
        if (Auth::user()->roletype === 'admin') {
            return redirect()->route('admin.surat_masuk.index');
        } elseif (Auth::user()->roletype === 'kepala') {
            return redirect()->route('kepala.surat_masuk.index');
        }elseif (Auth::user()->roletype === 'pegawai') {
            return redirect()->route('pegawai.surat_masuk.index');
        }
    }

    //hapus
    public function hapus($id){
        $suratmasuk = SuratMasuk::findOrFail($id);
    
        if ($suratmasuk->FileSurat && file_exists(public_path('uploads/surat_masuk/' . $suratmasuk->FileSurat))) {
            unlink(public_path('uploads/surat_masuk/' . $suratmasuk->FileSurat));
        }
        if ($suratmasuk->FileLampiran && file_exists(public_path('uploads/surat_masuk/' . $suratmasuk->FileLampiran))) {
            unlink(public_path('uploads/surat_masuk/' . $suratmasuk->FileLampiran));
        }
    
        $suratmasuk->delete();
        if (Auth::user()->roletype === 'admin') {
            return redirect()->route('admin.surat_masuk.index');
        } elseif (Auth::user()->roletype === 'kepala') {
            return redirect()->route('kepala.surat_masuk.index');
        }elseif (Auth::user()->roletype === 'pegawai') {
            return redirect()->route('pegawai.surat_masuk.index');
        }
    }

    //lihat
    public function lihat($id)
    {
        $suratmasuk = SuratMasuk::findOrFail($id);
        $tindaklanjutList = Tindaklanjut::with('user')->where('surat_masuk_id', $id)->get();
        $users = User::all();
        return view('SuratMasuk.lihat', compact('suratmasuk', 'tindaklanjutList', 'users'));
    }

    //disposisi
    public function disposisi($id){
        $suratmasuk = SuratMasuk::findOrFail($id);
        $pegawai = User::where('roletype', 'pegawai')->get();
        return view('SuratMasuk.disposisi', compact('suratmasuk','pegawai'));
    }

    public function simpan(Request $request, $id){

        $validasi = $request->validate([
            'disposisi' => 'required|string',
            'tujuan' => 'required|string'
        ]);
    
        $suratmasuk = SuratMasuk::findOrFail($id);
        $tujuanArray = array_map('trim', explode(',', $validasi['tujuan'])); 
        $suratmasuk->update([
            'disposisi' => $validasi['disposisi'],
            'tujuan' => $tujuanArray,
            'Status' => 'Belum di tindak lanjuti',
        ]);

        foreach ($tujuanArray as $namaUser) {
            $user = User::where('name', $namaUser)->first();
            if ($user) {
                Tindaklanjut::create([
                    'surat_masuk_id' => $suratmasuk->id,
                    'user_id' => $user->id,
                    'isi_tindaklanjut' => null, 
                ]);
            }
        }

        if (Auth::user()->roletype === 'admin') {
            return redirect()->route('admin.surat_masuk.index');
        } elseif (Auth::user()->roletype === 'kepala') {
            return redirect()->route('kepala.surat_masuk.index');
        }elseif (Auth::user()->roletype === 'pegawai') {
            return redirect()->route('pegawai.surat_masuk.index');
        }
    }

    //tindaklanjut
    public function tindaklanjut($id){
        $suratmasuk = SuratMasuk::findOrFail($id);
        return view('SuratMasuk.tindaklanjut', compact('suratmasuk'));
    }
    
    public function finish(Request $request, $id){
        $validasi = $request->validate([
            'tindaklanjut' => 'required|string',
        ]);
    
        $suratmasuk = SuratMasuk::findOrFail($id);

        Tindaklanjut::where('surat_masuk_id', $id)
            ->where('user_id', Auth::id())
            ->update(['isi_tindaklanjut' => $validasi['tindaklanjut']]);

        $belumSelesai = Tindaklanjut::where('surat_masuk_id', $id)
            ->whereNull('isi_tindaklanjut')
            ->exists();

        if (!$belumSelesai) {
            $suratmasuk->update(['Status' => 'Selesai']);
        }
    
        if (Auth::user()->roletype === 'admin') {
            return redirect()->route('admin.surat_masuk.index');
        } elseif (Auth::user()->roletype === 'kepala') {
            return redirect()->route('kepala.surat_masuk.index');
        }elseif (Auth::user()->roletype === 'pegawai') {
            return redirect()->route('pegawai.surat_masuk.index');
        }
    }

}
