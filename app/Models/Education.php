<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = [
        'image',
        'school',
        'degree',
        'gpa',
        'start_year',
        'end_year',
    ];

     public function aboutMe()
    {
        return $this->belongsTo(AboutMe::class);
    }
}
