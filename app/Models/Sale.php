<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_no', 
        'sale_date', 
        'sub_total', 
        'discount', 
        'grand_total'
    ];

    // Sale has many sale items
    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }

    // Sale has many payments
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
