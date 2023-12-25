<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GenerateUuid;
use App\Models\Items;
use App\Models\Customers;

class Orders extends Model
{
    use HasFactory, GenerateUuid;
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['uuid', 'customer_id', 'code', 'date', 'address', 'subtotal', 'discount', 'total'];

    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id', 'uuid');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class, 'order_id', 'uuid');
    }
}
