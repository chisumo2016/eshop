<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_price',
        'status',
         'session_id' , //- (stripe api)
        'user_id',
        'created_by',
        'updated_by',
    ];

    public function order_items():HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
