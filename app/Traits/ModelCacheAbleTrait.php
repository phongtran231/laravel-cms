<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait ModelCacheAbleTrait
{

  private static function setCache(): void
  {
    static::created(function (Model $instance) {
      static::actionOnSave($instance);
    });

    static::saved(function (Model $instance) {
      static::actionOnSave($instance);
    });
  }

  private static function actionOnSave(Model $instance)
  {
    $key = static::getCacheKey(1) . ':' . $instance->{$instance->getTable()};
    cache()->forget(md5(static::getCacheKey(0)));
    cache()->put(md5($key), $instance);
  }

  private static function removeCache()
  {
    static::deleted(function (Model $instance) {
      $key = static::getCacheKey(1) . ':' . $instance->{$instance->getTable()};
      cache()->forget(md5(static::getCacheKey(0)));
      cache()->forget(md5($key));
    });

    static::created(function () {
      cache()->forget(md5(static::getCacheKey(0)));
    });
  }

  public static function getCache(string $table, string $primaryKey)
  {
    $key = md5($table . ':' . $primaryKey);
    if (cache()->has($key)) {
      return cache()->get($key);
    }
    return null;
  }
}
