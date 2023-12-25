<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GenerateUuid;
use App\Models\Orders;

class Customers extends Model
{
    use HasFactory, GenerateUuid;
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['uuid', 'name', 'address', 'phone'];

    public function orders()
    {
        return $this->hasMany(Orders::class, 'customer_id', 'uuid');
    }
}
