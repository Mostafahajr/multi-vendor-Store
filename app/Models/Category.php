<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Category extends Model
{
    //
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
        'status',
        'image',
    ];



    protected function scopeFilter(Builder $builder){
        $builder->when($builder ?? false,function($builder, $value){
            $builder->where('name','=',$value);
        });
    }




    public function children(){
        return $this->hasMany(Category::class,'parent_id');
    }

    public function parent(){
        return $this->belongsTo(Category::class,'parent_id')->withDefault('_');
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    protected function rules($id = 0){
        return [
            'name'=>[
                'required',
                Rule::unique('categories','name')->ignore($id),
                'min:3',
                'max:255'
            ],
            'parent_id'=>[
                'nullable',
                'exists:categories,id',

            ],
            'image'=>[
                'image',

            ],
            'description'=>[
                'min:3',
                'max:255'
            ],
            'status'=>[
                'in:active,archived'
            ]
        ];
    }
}
