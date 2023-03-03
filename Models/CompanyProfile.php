<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'description_id',
        'description_en',
        'image',
    ];
    protected $appends = ['data_description']  ;

    public function scopeSelectByLocale($query)
    {
        $locale = session('language') ? session('language') : app()->getLocale() ;
        return $query->select(
            '*',
            // 'name_'.$locale.' as name',
            'description_'.$locale.' as description',
            // 'description_'.$locale.'_plain as description_plain',
            // 'description_'.$locale.'_plain_short as description_plain_short',
        );
    }
    public function getDataDescriptionAttribute()
    {
        $locale = session('language') ? session('language') : app()->getLocale() ;
        $num_char = 100;
        $text = strip_tags($this->attributes['description_'.$locale]);
        $text = str_replace('&nbsp;', ' ', $text);

        if(strlen($text) > $num_char){
            $char     = $text[$num_char - 1];
            while ($char != '.') {
                $char = $text[++$num_char]; // Cari spasi pada posisi 49, 48, 47, dst...
            }
            return substr($text, 0, $num_char).'.' ;
            // return $text;
        }else{
            return $text;
        }
    }

}
