<?php

namespace App\Models;

use App\Traits\HasLocalizedAttributes;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasLocalizedAttributes;

    protected $fillable = [
        'image',
        'school',
        'school_th',
        'degree',
        'degree_th',
        'gpa',
        'start_year',
        'end_year',
    ];

    public function aboutMe()
    {
        return $this->belongsTo(AboutMe::class);
    }
}
