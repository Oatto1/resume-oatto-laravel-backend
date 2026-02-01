<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'image',
        'company',
        'position',
        'start_year',
        'end_year',
        'description',
    ];

    public function aboutMe()
    {
        return $this->belongsTo(AboutMe::class);
    }
}

