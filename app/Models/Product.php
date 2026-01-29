<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id', 
        'size', 
        'qty_per_box', 
        'stock_boxes', 
        'default_price'
    ];

    // Product belongs to Brand
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Product has many sale items
    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }

    // Product has many stock movements
    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
    }
}
