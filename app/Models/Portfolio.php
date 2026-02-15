<?php

namespace App\Models;

use App\Traits\HasLocalizedAttributes;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasLocalizedAttributes;

    protected $fillable = [
        'title',
        'title_th',
        'subtitle',
        'type',
        'tech_stack',
        'image',
        'link',
        'description',
        'description_th',
    ];

    protected $casts = [
        'tech_stack' => 'array',
    ];

    public function images()
    {
        return $this->hasMany(PortfolioImage::class);
    }
}
