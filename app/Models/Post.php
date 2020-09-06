<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts";

    protected $guarded = ['id'];

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class, "sub_category_id", "id");
    }

    public function main_category()
    {
        return $this->belongsTo(MainCategory::class, "main_category_id", "id");
    }
}
