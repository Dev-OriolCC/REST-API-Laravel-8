<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ApiTrait;

class Brand extends Model
{
    use HasFactory, ApiTrait;

    protected $fillable = ['name', 'email', 'website'];

    // One to Many for products
    public function products() {
        return $this->hasMany(Product::class);
    }


}
