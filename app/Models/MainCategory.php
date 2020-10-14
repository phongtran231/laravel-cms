<?php

namespace App\Models;

use App\Traits\ModelCacheAbleTrait;
use App\Traits\ModelCacheInterface;
use App\Traits\TranslateAbleTrait;
use Illuminate\Support\Str;

class MainCategory extends BaseModel implements ModelCacheInterface
{
  use ModelCacheAbleTrait, TranslateAbleTrait;

  const CACHE_KEY = [
    'all_main_categories',
    'main_categories',
  ];

  public $translate = [
    'title' => 'string',
    'slug' => 'string',
    'description' => 'text',
    'content' => 'text',
  ];

  private static $cacheKey;

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

  /**
   * @param int|null $index
   * @return string
   */
  public static function getCacheKey(?int $index): string
  {
    return !is_null($index) ? static::CACHE_KEY[$index] : static::CACHE_KEY[0];
  }

  protected static function boot()
  {
    parent::boot();
    static::setCache();
    static::removeCache();
    static::saved(function ($item) {
      foreach (static::$data as $v) {
        $v['model_id'] = $item->id;
        $fieldType = $v['field_type'];
        unset($v['field_type']);
        $translateClass = 'App\\Models\\'. Str::studly("{$fieldType}_translate");
        $translateInstance = new TextTranslate();
        $translateInstance->fill($v)->save();
      }
    });
  }

}
