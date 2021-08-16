<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    //
    // * Properties to allow in the query scopes.
    protected $allowIncluded = ['products', 'products.brands'];
    protected $allowFilter = ['id', 'name'];
    protected $allowSort = ['id', 'name'];

    public function scopeIncluded(Builder $query) {
        if (empty($this->allowIncluded) || empty(request('included')) ) {
            return;
        }

        $relations = explode(',', request('include')); 
        $allowIncluded = collect($this->allowIncluded);
        foreach ($relations as $key => $relationship) {
            if (!$allowIncluded->contains($relations)) {
                unset($relations[$key]);
            }
        }

        $query->with($relations);
    }

    public function scopeFilter(Builder $query) {
        if (empty($this->allowFilter) || empty(request('filter'))) {
            return;
        }
        $filters = request('filter');
        $allowFilter = collect($this->allowFilter);

        foreach ($filters as $filter => $value) {
            if ($allowFilter->contains($filter)) {
                $query->where($filter, 'LIKE', '%'. $value .'%');
            }
        }
    }

    public function scopeSort(Builder $query) {
        if (empty($this->allowSort) || empty(request('sort'))) {
            return; // * Return if not found..
        }
        $sortFields = explode(',', request('sort'));
        $allowSort = collect($this->allowSort);
        foreach ($sortFields as $sortField) {

            $direction = 'asc';

            if (substr($sortField, 0, 1) == '-' ) {
                $direction = 'desc';
                $sortField = substr($sortField, 1);
            }

            if ($allowSort->contains($sortField)) {
                $query->orderBy($sortField, $direction);
            }

        }

    }

    // One-to-Many for products
    public function products() {
        return $this->hasMany(Product::class);
    }


}
