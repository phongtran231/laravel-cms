<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = "sub_categories";

    protected $guarded = ['id'];

    public function main_category()
    {
        return $this->belongsTo(MainCategory::class, "main_category_id", "id");
    }

    public function posts()
    {
        return $this->hasMany(Post::class, "sub_category_id", "id");
    }
}
