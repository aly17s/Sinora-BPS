<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    //index
    public function index(){ 
        $user = Auth::user();
        $jabatans = Jabatan::all(); 
    return view('website.setting.user_settings', compact('user', 'jabatans'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $jabatans = Jabatan::all(); 
        return view('user_setting', compact('user', 'jabatans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|min:6',
            'jabatan' => 'nullable|string',
            'roletype' => 'required|string|in:pegawai,kepala,admin',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->jabatan = $request->input('jabatan');
        $user->roletype = $request->input('roletype');

        $user->save();

        if (Auth::user()->roletype === 'admin') {
            return redirect()->route('admin.user_settings.index');
        } elseif (Auth::user()->roletype === 'kepala') {
            return redirect()->route('kepala.user_settings.index');
        } else {
            return redirect()->route('pegawai.user_settings.index');
        }
    }
}
