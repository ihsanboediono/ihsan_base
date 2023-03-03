<?php

namespace App\Models;

use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Searchable\Searchable;

class Service extends Model implements Searchable
{
    use HasFactory;

    protected $fillable = [
        'name_id',
        'name_en',
        'description_id',
        'description_en',
        'image',
        'icon',
        'date',
    ];

    protected $appends = [
        'text_description', 
        'image_url',
        'icon_url'
    ];

    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            searchable: $this->load('category'),
            title: $this->title_en,
            url: null
        );
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => url('storage/'.$this->image),
        );
    }
    protected function iconUrl(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => url('storage/'.$this->icon),
        );
    }
    public function getTextDescriptionAttribute()
    {
        $num_char = 80;
        $text = strip_tags($this->attributes['description_id']);
        $text = str_replace('&nbsp;', ' ', $text);

        if(strlen($text) > $num_char){
            $char     = $text[$num_char - 1];
            while ($char != ' ') {
                $char = $text[--$num_char]; // Cari spasi pada posisi 49, 48, 47, dst...
            }
            return substr($text, 0, $num_char) . '...';
            // return $text;
        }else{
            return $text;
        }
    }
    public function scopeSelectByLocale($query)
    {
        $locale = session('language') ? session('language') : app()->getLocale() ;
        return $query->select(
            '*',
            'name_'.$locale.' as name',
            'description_'.$locale.' as description',
            // 'description_'.$locale.'_plain as description_plain',
            // 'description_'.$locale.'_plain_short as description_plain_short',
        );
    }
}
