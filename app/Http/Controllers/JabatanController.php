<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JabatanController extends Controller
{
    //index
    public function index(){
        $jabatans = Jabatan::all();
        return view('website.admin.manajemen_jabatan', compact('jabatans'));
    }

    //tambah
    public function create(){
        return view('jabatan.create');
    }

    public function input(Request $request){
        $validasi = $request->validate([
            'Jabatan' => 'required'
        ]);

        Jabatan::create($validasi);
        if (Auth::user()->roletype === 'admin') {
            return redirect()->route('admin.manajemen_jabatan.index');
        } elseif (Auth::user()->roletype === 'kepala') {
            return redirect()->route('kepala.manajemen_jabatan.index');
        }
    }

    //hapus
    public function hapus($id){
        $jabatan = Jabatan::find($id);
        $jabatan->delete();
        if (Auth::user()->roletype === 'admin') {
            return redirect()->route('admin.manajemen_jabatan.index');
        } elseif (Auth::user()->roletype === 'kepala') {
            return redirect()->route('kepala.manajemen_jabatan.index');
        }
    }

}

