<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'invitation_id',
        'order_id',
        'payment_type',
        'transaction_status',
        'gross_amount',
        'response',
    ];
}
