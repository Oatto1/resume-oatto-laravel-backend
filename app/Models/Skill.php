<?php

namespace App\Models;

use App\Traits\HasLocalizedAttributes;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasLocalizedAttributes;

    protected $fillable = [
        'title',
        'title_th',
        'image',
    ];
}
