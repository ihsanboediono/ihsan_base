<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'whatsapp',
        'instagram',
        'linkedin',
        'facebook',
        'email',
        'address',
        'telephone',
    ];
}
