<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ApiTrait;

class Tag extends Model
{
    use HasFactory, ApiTrait;

    protected $fillable = ['name'];

    // Many-to-Many
    public function products() {
        return $this->belongsToMany(Product::class);
    }

}
