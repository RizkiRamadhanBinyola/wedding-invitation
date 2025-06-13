<?php

// app/Models/Invitation.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'theme_id',
        'slug',
        'nama_wanita',
        'nama_pria',
        'ortu_wanita',
        'ortu_pria',
        'anak_ke',
        'tanggal',
        'lokasi',
        'no_telp',
        'email',
        'waktu_akad',
        'waktu_resepsi',
        'no_rekening',
        'instagram',
        'musik'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }
}
