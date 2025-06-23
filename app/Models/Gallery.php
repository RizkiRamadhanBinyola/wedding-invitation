<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['invitation_id', 'path', 'caption'];

    /* relasi balik */
    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }
}
