<?php

namespace App\Models;

use App\Traits\Model\ImageUrl;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Traits\Model\DescriptionEnPlain;
use App\Traits\Model\DescriptionIdPlain;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model implements Searchable
{
    use HasFactory;
    use ImageUrl;
    use DescriptionIdPlain;
    use DescriptionEnPlain;

    protected $fillable = [
        'product_category_id',
        'name_id',
        'name_en',
        'description_id',
        'description_en',
        'image',
        'slug',
        'link',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    protected $appends = ['image_url', 'description_id_plain', 'description_id_plain_short', 'description_en_plain', 'description_en_plain_short'];

    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            searchable: $this->load('productSubcategories'),
            title: $this->name_en,
            url: null
        );
    }

    public function productSubcategories()
    {
        return $this->belongsTo(ProductSubcategory::class, 'product_subcategory_id');
    }

    public function scopeByMonth($query, $month)
    {
        return $query->whereMonth('created_at', $month);
    }
    public function scopeThisYear($query)
    {
        return $query->whereYear('created_at', date('Y'));
    }

    public function scopeSelectByLocale($query)
    {
        $locale = session('language') ? session('language') : app()->getLocale() ;
        return $query->select(
            '*',
            'name_'.$locale.' as name',
            'description_'.$locale.' as description',

        );
    }
}   
