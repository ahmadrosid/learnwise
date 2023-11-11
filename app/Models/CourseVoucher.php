<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseVoucher extends Model
{
    use HasFactory;

    protected $table = 'course_voucher';

    protected $fillable = ['course_id', 'voucher_id'];
}
