<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'link',
        'logo',
    ];

    protected $appends = ['image_url']  ;

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => url('storage/'.$this->logo),
        );
    }
    public function scopeByMonth($query, $month)
    {
        return $query->whereMonth('created_at', $month);
    }
    public function scopeThisYear($query)
    {
        return $query->whereYear('created_at', date('Y'));
    }
    
}
