<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public $fillable = [
        'transaction_id', 
        'amount', 
        'token', 
        'card_number', 
        'status', 
        'verify_status'
    ];
}
