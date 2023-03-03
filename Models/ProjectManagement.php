<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Model\DescriptionEnPlain;
use App\Traits\Model\DescriptionIdPlain;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectManagement extends Model
{
    use HasFactory;
    use DescriptionIdPlain;
    use DescriptionEnPlain;

    protected $fillable = [
        'title_id',
        'title_en',
        'description_id',
        'description_en',
        'icon',
    ];

    protected $appends = ['description_id_plain', 'description_id_plain_short', 'description_en_plain', 'description_en_plain_short', 'icon_url'];

    protected function iconUrl(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => url('storage/'.$this->icon),
        );
    }
}
