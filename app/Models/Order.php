<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'country',
        'zip',
        'payment_method',
        'payment_reference',
        'total_amount',
        'user_id',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
