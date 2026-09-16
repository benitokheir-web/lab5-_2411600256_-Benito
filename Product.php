<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'description',
        'category',
        'quantity',
        'reorder_level',
        'unit_price',
        'supplier',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'reorder_level' => 'integer',
        'unit_price' => 'decimal:2',
    ];

    public function transactions()
    {
        return $this->hasMany(InventoryTransaction::class);
    }

    public function isLowStock(): bool
    {
        return $this->quantity > 0 && $this->quantity <= $this->reorder_level;
    }

    public function isOutOfStock(): bool
    {
        return $this->quantity <= 0;
    }
}
