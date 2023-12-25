<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GenerateUuid;
use App\Models\Orders;
use App\Models\Items;

class OrderItems extends Model
{
    use HasFactory, GenerateUuid;
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['uuid', 'order_id', 'item_id', 'qty', 'price', 'discount', 'total', 'note'];

    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id', 'uuid');
    }

    public function item()
    {
        return $this->belongsTo(Items::class, 'item_id', 'uuid');
    }
}
