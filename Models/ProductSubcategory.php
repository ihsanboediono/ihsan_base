<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_category_id',
        'name_id',
        'name_en',
        'slug',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'product_subcategory_id');
    }
}
