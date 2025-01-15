<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'status',
    ];
    use HasFactory;


public function user()
{
    return $this->belongsTo(User::class);
}


public function orderDetail()
{
    return $this->hasOne(OrderDetail::class);
}

public function details()
{
    return $this->hasMany(OrderDetail::class);
}
}



// order->order_details->subtotal