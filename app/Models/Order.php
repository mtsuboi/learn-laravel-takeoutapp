<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OrderDetail;

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
}
