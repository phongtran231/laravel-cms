<?php

namespace App\Traits;

interface ModelCacheInterface
{
  public static function getCacheKey(?int $index);
}
