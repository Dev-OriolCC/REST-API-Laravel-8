<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const PUBLISHED = 2;
    const UNPUBLISHED = 1;
    
    // One-to-Many inverse for brand
    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    // One-to-Many inverse for category
    public function category() {
        return $this->belongsTo(Category::class);
    }

    // Many-to-Many for tags
    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    // One-to-Many for images Polimorfic
    public function images() {
        return $this->morphMany(Image::class, 'imageable');
    }

}
