<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    /* ──────────────── Konstanta Status (opsional) ──────────────── */
    public const STATUS_DRAFT     = 'draft';
    public const STATUS_PUBLISHED = 'published';

    /* ─────────────────────── Mass Assignment ───────────────────── */
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
        'musik',

        'status',  // draft / published (optional)
    ];

    /* ──────────────────────── Relations ───────────────────────── */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    /* ──────────────────────── Scopes ──────────────────────────── */
    public function scopePublished($q)
    {
        return $q->where('status', self::STATUS_PUBLISHED);
    }

    public function scopeDraft($q)
    {
        return $q->where('status', self::STATUS_DRAFT);
    }
}
