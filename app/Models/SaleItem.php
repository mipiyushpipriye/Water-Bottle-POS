<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'product_id',
        'boxes',
        'rate',
        'total'
    ];

    // SaleItem belongs to Sale
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    // SaleItem belongs to Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
