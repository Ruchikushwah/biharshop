<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;
    public function orderItems(): HasMany
    {
return $this->hasMany(orderItem::class, 'order_id', 'id');
    }


    public function Coupon():HasOne
    {
        return $this->hasOne(Coupon::class,'id', 'coupon_id');
    }
        
    }


