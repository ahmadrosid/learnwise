<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'category_id', 'course_id', 'course_id', 'is_published', 'is_free', 'position'
    ];
}
