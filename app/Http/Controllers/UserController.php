<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //index
    public function index(){
        $users = User::paginate(10);
        return view('website.admin.manajemen_anggota', compact('users'));
    }

    //Tambah data
    public function create(){
        $jabatans = Jabatan::all();
        return view('pengguna.create', compact('jabatans'));
    }

    public function input(Request $request){
        $validasi = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:4',
            'jabatan' => 'required',
            'roletype' => 'required',
            
        ], [
            'name.required' => 'Nama tidak boleh kosong.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password tidak boleh kosong.',
            'jabatan.required' => 'Jabatan harus dipilih.',
            'roletype.required' => 'Role harus dipilih.',
           
        ]);

        $validasi['password'] = Hash::make($request->password);
        User::create($validasi);
        if (Auth::user()->roletype === 'admin') {
            return redirect()->route('admin.manajemen_anggota.index');
        } elseif (Auth::user()->roletype === 'kepala') {
            return redirect()->route('kepala.manajemen_anggota.index');
        }
    }

    //edit data
    public function edit($id){
        $user = User::findOrFail($id);
        $jabatans = Jabatan::all();
        return view('pengguna.edit', compact('user', 'jabatans'));
    }

    public function update(Request $request, $id){
        $user = User::findOrFail($id);
        
        $validasi = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'jabatan' => 'required',
            'roletype' => 'required',
            'password' => 'nullable|min:4',
        ]);
    
        // Jika password diisi, hash password baru
        if ($request->filled('password')) {
            $validasi['password'] = Hash::make($request->password);
        } else {
            unset($validasi['password']);
        }
    
        $user->update($validasi);
        if (Auth::user()->roletype === 'admin') {
            return redirect()->route('admin.manajemen_anggota.index');
        } elseif (Auth::user()->roletype === 'kepala') {
            return redirect()->route('kepala.manajemen_anggota.index');
        }
    }

    //hapus data
    public function hapus($id){
        $user = User::find($id);
        $user->delete();
        if (Auth::user()->roletype === 'admin') {
            return redirect()->route('admin.manajemen_anggota.index');
        } elseif (Auth::user()->roletype === 'kepala') {
            return redirect()->route('kepala.manajemen_anggota.index');
        }
    }
}
