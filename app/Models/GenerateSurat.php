<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenerateSurat extends Model
{
    use HasFactory;

    protected $table = 'generate_surats';

    protected $fillable = [
        'nomor1', 'nomor2', 'nomor3', 'nomor4', 'tempat', 'tanggal', 'sifat', 
        'lampiran', 'hal', 'tujuan', 'isi', 'pengirim', 'jabatan', 'nip', 'file_path'
    ];
}
