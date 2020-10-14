<?php

namespace Modules\Admin\Services\MainCategory;

use App\Models\MainCategory;
use App\Traits\DataCache;
use Illuminate\Database\Eloquent\Collection;

class MainCategoryService implements MainCategoryServiceInterface
{
  use DataCache;

  private $mainCategory;

  public function __construct(
    MainCategory $mainCategory
  )
  {
    $this->mainCategory = $mainCategory;
  }

  public function getAllMainCategory(): Collection
  {
    $this->mainCategory->setTranslation('content', 'test');
    $this->mainCategory->user_created = 1;
    $this->mainCategory->save();
    die;
    if ($data = $this->getCache(MainCategory::getCacheKey(0))) {
      return $data;
    }
    $data = $this->mainCategory->whereActive(true)->get();
    $this->setCache(MainCategory::getCacheKey(0), $data);
    return $data;
  }

  /**
   * @param int $id
   * @return \Illuminate\Contracts\Cache\Repository|mixed|null
   * @throws \Exception
   */
  public function getMainCategory(int $id)
  {
    if ($data = $this->getCache(MainCategory::getCacheKey(1) . ':' . $id)) {
      return $data;
    }
    $data = $this->mainCategory->find($id);
    if ($data) {
      $this->setCache(MainCategory::getCacheKey(1) . ':' . $id, $data);
      return $data;
    }
    return null;
  }
}
