<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'city',
        'postal_code',
        'notes',
        'subtotal',
        'delivery_charges',
        'total',
        'status',
    ];

   public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}

}
