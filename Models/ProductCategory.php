<?php

namespace App\Models;

use App\Traits\Model\DescriptionEnPlain;
use App\Traits\Model\DescriptionIdPlain;
use App\Traits\Model\ImageUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    use DescriptionIdPlain;
    use DescriptionEnPlain;
    use ImageUrl;

    protected $fillable = [
        // 'name_id',
        // 'name_en',
        'title_id',
        'title_en',
        'image',
        'slug',
    ];

    // protected $appends = ['image_url', 'description_id_plain', 'description_id_plain_short', 'description_en_plain', 'description_en_plain_short'];

    // public function product()
    // {
    //     return $this->belongsToMany(Product::class);
    // }


    public function scopeSelectByLocale($query)
    {
        $locale = session('language') ? session('language') : app()->getLocale() ;
        return $query->select(
            '*',
            'title_'.$locale.' as title',
            // 'subtitle_'.$locale.' as subtitle',
            // 'description_'.$locale.' as description',

        );
    }
}
