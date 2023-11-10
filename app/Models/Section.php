<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'course_id', 'next_section_id'];

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
}
