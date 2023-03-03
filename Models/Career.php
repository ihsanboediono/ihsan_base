<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Career extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_id',
        'title_en',
        'start_date',
        'end_date',
        'description_id',
        'description_en',
        'image',
    ];

    protected $appends = ['text_description', 'data_description', 'image_url']  ;

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => url('storage/'.$this->image),
        );
    }
    public function getTextDescriptionAttribute()
    {
        $num_char = 110;
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
    public function getDataDescriptionAttribute()
    {
        $locale = session('language') ? session('language') : app()->getLocale() ;
        $num_char = 80;
        $text = strip_tags($this->attributes['description_'.$locale]);
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
            'title_'.$locale.' as title',
            'description_'.$locale.' as description',
            // 'description_'.$locale.'_plain as description_plain',
            // 'description_'.$locale.'_plain_short as description_plain_short',
        );
    }
    public function getStatusAttribute()
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $this->attributes['start_date']);
        $endDate = Carbon::createFromFormat('Y-m-d', $this->attributes['end_date']);

        // return Carbon::now();
        if (Carbon::now() < $startDate) {
            return 'akan datang';
        }else{
            $check = Carbon::now()->between($startDate, $endDate);
            if ($check == true) {
                return 'buka';
            }else{
                return 'tutup';
            }
        }
    }
}
