<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
    use HasFactory,SoftDeletes;

    protected static function booted()
    {
        static::addGlobalScope('store',new StoreScope());
    }

    protected $fillable = [
        'name',
        'description',
        'slug',
        'image',
        'price',
        'compare_price',
        'options',
        'rating',
        'featured',
        'status',
        'store_id',
        'category_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

}
