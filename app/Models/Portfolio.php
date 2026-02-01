<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'type',
        'tech_stack',
        'image',
        'link',
        'description',
    ];

    public function images()
    {
        return $this->hasMany(PortfolioImage::class);
    }
}
