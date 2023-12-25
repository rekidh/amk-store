<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GenerateUuid;
use App\Models\Items;

class Category extends Model
{
    use HasFactory, GenerateUuid;
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['uuid', 'name'];

    public function items()
    {
        return $this->hasMany(Items::class, 'category_id', 'uuid');
    }
}
