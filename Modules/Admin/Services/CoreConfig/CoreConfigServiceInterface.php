<?php

namespace Modules\Admin\Services\CoreConfig;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface CoreConfigServiceInterface
{
  /**
   * store core configs
   * @param array $attributes
   * @return mixed
   */
  public function storeCoreConfig(array $attributes);

  /**
   * @return Collection|null
   */
  public function getAllConfig(): ?Collection;

  /**
   * @param int $id
   * @return mixed
   */
  public function getConfig(int $id);

  /**
   * @param Request $request
   * @param int $id
   * @return mixed
   */
  public function updateConfig(Request $request, int $id);

  public function deleteConfig(int $id);
}
