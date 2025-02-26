<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tindaklanjut extends Model
{
    use HasFactory;

    protected $table = 'tindaklanjuts';
    protected $fillable = ['surat_masuk_id','user_id','isi_tindaklanjut'];

    protected $casts = [
        'isi_tindaklanjut' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function suratMasuk()
    {
        return $this->belongsTo(SuratMasuk::class, 'surat_masuk_id');
    }

}



