<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'user_id', 'is_published', 'price', 'thumbnail'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
