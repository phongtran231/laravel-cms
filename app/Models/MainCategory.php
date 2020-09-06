<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    protected $table = "main_categories";

    protected $guarded = ['id'];

    public function sub_categories()
    {
        return $this->hasMany(SubCategory::class, "main_category_id", "id");
    }

    public function posts()
    {
        return $this->hasMany(Post::class, "main_category_id", "id");
    }

    public function posts_though_sub()
    {
        return $this->hasManyThrough(Post::class, SubCategory::class, "main_category_id", "sub_category_id", "id", "id");
    }

    public function all_posts()
    {
        return $this->posts()->get()->merge($this->posts_though_sub()->get());
    }
}
