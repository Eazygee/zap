<?php

namespace App\Models;

use App\Constants\General\AppConstants;
use App\Constants\General\StatusConstants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function vendor()
    {
        return $this->belongsTo(User::class, "vendor_id");
    }

    public function getPrice()
    {
        return $this->price - $this->discount;
    }

    public function getRealPrice()
    {
        return $this->price;
    }

    public function discountPercent()
    {
        if ($this->discount == 0) {
            return 0;
        }
        return number_format($this->discount * 100 / $this->price);
    }

    public function scopeSearch($query, $value)
    {
        if (!empty($value)) {
            $query->whereRaw("CONCAT(name,' ', reference) LIKE ?", ["%$value%"])
                ->orWhere("name", "like", "%$value%");
        }
    }

}
