<?php

namespace App\Models;

use App\Traits\ModelCacheAbleTrait;
use App\Traits\ModelCacheInterface;

class CoreConfig extends BaseModel implements ModelCacheInterface
{
  use ModelCacheAbleTrait;

  private static $cacheKey;

  const CACHE_KEY = [
    'all_core_configs',
    'core_configs'
  ];

  protected $table = 'core_configs';

  protected $guarded = [
    'id'
  ];

  /**
   * @param int|null $index
   * @return string
   */
  public static function getCacheKey(?int $index): string
  {
    return !is_null($index) ? static::CACHE_KEY[$index] : static::CACHE_KEY[0];
  }

}
