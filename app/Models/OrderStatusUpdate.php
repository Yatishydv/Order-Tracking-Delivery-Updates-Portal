<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['order_id', 'status', 'message'])]
class OrderStatusUpdate extends Model
{
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
