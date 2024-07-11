<?php

namespace App\Models;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Sluggable;
    protected $fillable = [
        'name',
        'thumbnail',
        'image',
        'slug',
        'content',
        'cat_ust',
        'status',
    ];

    public function items() {
        return $this->hasMany(Product::class,'category_id','id');
    }

    public function subcategory(){
        return $this->hasmany(Category::class,'cat_ust','id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
