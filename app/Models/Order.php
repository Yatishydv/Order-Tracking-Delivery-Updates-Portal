<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['user_id', 'product_name', 'address', 'status', 'assigned_agent_id', 'estimated_delivery'])]
class Order extends Model
{
    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'assigned_agent_id');
    }

    public function updates()
    {
        return $this->hasMany(OrderStatusUpdate::class)->latest();
    }

    protected function casts(): array
    {
        return [
            'estimated_delivery' => 'datetime',
        ];
    }
}
