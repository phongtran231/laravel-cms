<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
  public function getDataFromCache()
  {
    $key = $this->getTable() . ':' . $this->getKeyName();
    $key = md5($key);
    return cache()->get($key);
  }
}
