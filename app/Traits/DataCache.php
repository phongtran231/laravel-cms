<?php

namespace App\Traits;

trait DataCache
{
  /**
   * set cache from key
   * @param $key
   * @param $data
   * @return void
   * @throws \Exception
   */
  public function setCache($key, $data): void
  {
    $key = md5($key);
    if (!empty($data)) {
      cache()->put($key, $data);
    }
  }

  /**
   * return cache from key
   * @param $key
   * @return void
   * @throws \Exception
   */
  public function removeCache($key): void
  {
    $key = md5($key);
    cache()->forget($key);
  }

  /**
   * get cache from key
   * @param $key
   * @return \Illuminate\Contracts\Cache\Repository|mixed
   * @throws \Exception
   */
  public function getCache($key)
  {
    $key = md5($key);
    return cache()->get($key);
  }
}
