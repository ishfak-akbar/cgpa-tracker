<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'semester_id', 'code', 'title', 'credits', 'grade'
    ];
}