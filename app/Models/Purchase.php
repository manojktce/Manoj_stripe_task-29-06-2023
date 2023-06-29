<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'stripe_id', 'user_id', 'product_id', 'amount' , 'quantity', 'invoice'
    ];
}
