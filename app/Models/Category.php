<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;  //! Need to test if works without this library.

use App\Traits\ApiTrait;

class Category extends Model
{
    use HasFactory, ApiTrait;

    protected $fillable = ['name'];
    //
    // ? Properties to allow in the query scopes.
    protected $allowIncluded = ['products', 'products.brands'];
    protected $allowFilter = ['id', 'name'];
    protected $allowSort = ['id', 'name'];


    // One-to-Many for products
    public function products() {
        return $this->hasMany(Product::class);
    }


}
