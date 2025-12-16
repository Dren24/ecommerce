<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'brand_id',
        'supplier_id',
        'name',
        'slug',
        'description',
        'quantity',
        'minimum_quantity',
        'part_number',
        'motorcycle_brand',
        'fit_to_model',
        'price',            // ✔ FIXED
        'image',
        'is_active',
    ];

    protected $casts = [
        'image' => 'string',
        'is_active' => 'boolean',
        'price' => 'decimal:2',   // ✔ FIXED
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
