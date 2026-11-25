<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'sku', 'category', 'description', 'unit_cost', 'unit_price',
        'stock_qty', 'unit', 'reorder_level',
    ];

    protected function casts(): array
    {
        return [
            'unit_cost' => 'decimal:2',
            'unit_price' => 'decimal:2',
        ];
    }

    public function needsReorder(): bool
    {
        return $this->stock_qty <= $this->reorder_level;
    }
}
