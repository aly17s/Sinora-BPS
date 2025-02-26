<?php

namespace App\Http\Controllers;

use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GenerateSurat;
use Carbon\Carbon;


class SuratKeluarController extends Controller
{
    //index
    public function index()
    {
        $surats = GenerateSurat::all();
        return view('website.SuratKeluar.surat_keluar', compact('surats'));
    }

    //generate surat
    public function generateSurat(Request $request)
    {
        $tahunSekarang = Carbon::now()->year;
        $jumlahSurat = GenerateSurat::whereYear('created_at', $tahunSekarang)->count();

        $nomor2Formatted = str_pad($jumlahSurat, 3, '0', STR_PAD_LEFT);
        if ($jumlahSurat == 0) {
            $nomor2Formatted = '001';
        } else {
            $nomor2Formatted = str_pad($jumlahSurat + 1, 3, '0', STR_PAD_LEFT);
        }

        $request->validate([
            'nomor1' => 'required', 'nomor3' => 'required', 'nomor4' => 'required',
            'tempat' => 'required', 'tanggal' => 'required', 'sifat' => 'required',
            'lampiran' => 'required', 'hal' => 'required', 'tujuan' => 'required',
            'isi' => 'required', 'pengirim' => 'required', 'jabatan' => 'required', 'nip' => 'required'
        ]);

        $data = $request->all();
        $data['nomor2'] = $nomor2Formatted;
    
        $templatePath = public_path('templates/Testing.docx');
    
        if (!File::exists($templatePath)) {
            return back()->with('error', 'Template surat tidak ditemukan.');
        }
    
        $templateProcessor = new TemplateProcessor($templatePath);
    
        foreach ($data as $key => $value) {
            $templateProcessor->setValue($key, $value);
        }
    
        $fileName = 'surat_' . time() . '.docx';
        $filePath = 'generate/' . $fileName;
        $outputPath = public_path($filePath);
        $templateProcessor->saveAs($outputPath);
    
        $data['file_path'] = $filePath;
        GenerateSurat::create($data);
    
        if (Auth::user()->roletype === 'admin') {
            return redirect()->route('admin.surat_keluar.index')->with('success', 'Surat berhasil dibuat dan disimpan.');
        } elseif (Auth::user()->roletype === 'kepala') {
            return redirect()->route('kepala.surat_keluar.index')->with('success', 'Surat berhasil dibuat dan disimpan.');
        } elseif (Auth::user()->roletype === 'pegawai') {
            return redirect()->route('pegawai.surat_keluar.index')->with('success', 'Surat berhasil dibuat dan disimpan.');
        }
    
        return abort(403, 'Unauthorized');
    }

    //hapus
    public function deleteSurat($id)
    {
        $surat = GenerateSurat::findOrFail($id);

        $filePath = public_path($surat->file_path);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $surat->delete();

        if (Auth::user()->roletype === 'admin') {
            return redirect()->route('admin.surat_keluar.index');
        } elseif (Auth::user()->roletype === 'kepala') {
            return redirect()->route('kepala.surat_keluar.index');
        } elseif (Auth::user()->roletype === 'pegawai') {
            return redirect()->route('pegawai.surat_keluar.index');
        }
        
        return abort(403, 'Unauthorized');
    }

    //download
    public function downloadSurat($id)
{
    $surat = GenerateSurat::findOrFail($id);
    $filePath = public_path($surat->file_path);

    if (File::exists($filePath)) {
        return response()->download($filePath);
    }

    return back()->with('error', 'File tidak ditemukan.');
}

}
