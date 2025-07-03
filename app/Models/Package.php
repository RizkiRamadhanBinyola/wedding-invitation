<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    //
    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }
}
