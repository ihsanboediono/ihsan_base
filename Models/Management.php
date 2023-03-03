<?php

namespace App\Models;

use App\Traits\Model\ImageUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    use HasFactory;
    use ImageUrl;

    protected $appends = ['image_url'];

    protected $fillable = [
        'name',
        'position_id',
        'position_en',
        'image',
    ];
    public function scopeSelectByLocale($query)
    {
        $locale = session('language') ? session('language') : app()->getLocale() ;
        return $query->select(
            '*',
            'position_'.$locale.' as position',
            // 'description_'.$locale.' as description',
            // 'description_'.$locale.'_plain as description_plain',
            // 'description_'.$locale.'_plain_short as description_plain_short',
        );
    }
}
