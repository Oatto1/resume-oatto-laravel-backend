<?php

namespace App\Models;

use App\Traits\HasLocalizedAttributes;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasLocalizedAttributes;

    protected $fillable = [
        'image',
        'company',
        'company_th',
        'position',
        'position_th',
        'start_year',
        'end_year',
        'description',
        'description_th',
    ];

    public function aboutMe()
    {
        return $this->belongsTo(AboutMe::class);
    }
}
