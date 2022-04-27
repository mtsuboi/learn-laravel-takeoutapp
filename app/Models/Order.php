<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_datetime',
        'user_id',
        'scheduled_date',
        'scheduled_time',
        'cancel_datetime',
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
