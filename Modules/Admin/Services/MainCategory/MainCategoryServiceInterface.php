<?php

namespace Modules\Admin\Services\MainCategory;

use Illuminate\Database\Eloquent\Collection;

interface MainCategoryServiceInterface
{

  /**
   * @return Collection
   */
  public function getAllMainCategory(): Collection;

  /**
   * @param int $id
   * @return mixed
   */
  public function getMainCategory(int $id);
}
