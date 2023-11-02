<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'checkout_link',
        'external_id',
        'status',
        'user_id',
        'course_id',
        'description',
        'amount',
        'type',
        'status',
    ];
}
