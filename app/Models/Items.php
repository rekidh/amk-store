<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GenerateUuid;
use App\Models\Category;
use App\Models\OrderItems;

class Items extends Model
{
    use HasFactory, GenerateUuid;
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['uuid', 'name', 'price', 'description', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'uuid');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class, 'item_id', 'uuid');
    }
}
