<?php

namespace App\Models;

use App\Enums\DeliveryStatus;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Date;

class Order extends Model
{
    use HasFactory;
    protected $appends = ['order_status_description', 'payment_status_description', 'delivery_status_description'];
    protected $hidden = ['order_status', 'payment_status', 'delivery_status'];
    protected $casts = [
        'order_status' => OrderStatus::class,
        'payment_status' => PaymentStatus::class,
        'delivery_status' => DeliveryStatus::class,
        'order_date' => 'datetime:d/m/Y',
        'completion_date' => 'datetime:d/m/Y',
        'cancellation_date' => 'datetime:d/m/Y',
    ];
    public function getOrderStatusDescriptionAttribute($value)
    {
        return $this->order_status->description;
    }
    public function getPaymentStatusDescriptionAttribute($value)
    {
        return $this->payment_status->description;
    }

    public function getDeliveryStatusDescriptionAttribute($value)
    {
        return $this->delivery_status->description;
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
