<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Order.
 *
 * @package namespace App\Models;
 */
class Order extends Model
{
    use  SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function getStatus()
    {
        return $this->getModelStatus($this->status);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, "order_id");
    }

    public function deliveryAddress()
    {
        return $this->belongsTo(DeliveryAddress::class, "delivery_address_id");
    }
    public function getAddressAttribute()
    {
        $address = $this->deliveryAddress;
        return $address->address . ", " . $address->city . ", " . $address->state;
    }
}
