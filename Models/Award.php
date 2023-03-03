<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Award extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_id',
        'name_en',
        'description_id',
        'description_en',
        'image',
        'date',
    ];

    protected $appends = ['text_description', 'image_url']  ;


    public function scopeByMonth($query, $month)
    {
        return $query->whereMonth('created_at', $month);
    }
    public function scopeThisYear($query)
    {
        return $query->whereYear('created_at', date('Y'));
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => url('storage/'.$this->image),
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
}
