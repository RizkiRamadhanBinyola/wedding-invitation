<?php

// app/Models/Greeting.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Greeting extends Model
{
    protected $fillable = [
        'invitation_id', 'nama_pengirim', 'isi_ucapan',
    ];

    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }
}

