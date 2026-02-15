<?php

namespace App\Models;

use App\Traits\HasLocalizedAttributes;
use Illuminate\Database\Eloquent\Model;

class AboutMe extends Model
{
    use HasLocalizedAttributes;

    protected $fillable = [
        'main_image',
        'name',
        'name_th',
        'position',
        'position_th',
        'description',
        'description_th',
        'email',
        'phone',
        'github_link',
    ];

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function education()
    {
        return $this->hasMany(Education::class);
    }
}
