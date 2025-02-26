<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;
    protected $table = 'surat_masuks';
    protected $fillable =[ 'NoSurat', 'TanggalSurat', 'TanggalTerima', 'Dari', 'TingkatKeamanan', 'Status', 'Ringkasan', 'FileSurat', 'FileLampiran', 'tujuan', 'disposisi'];

    protected $casts = [
        'tujuan' => 'array',
    ];
}
