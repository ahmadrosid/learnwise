<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'course_id', 'chapter_id', 'created_at'];

    protected $table = 'progresses';
}
