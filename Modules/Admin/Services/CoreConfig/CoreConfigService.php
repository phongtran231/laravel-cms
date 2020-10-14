<?php

namespace Modules\Admin\Services\CoreConfig;

use App\Models\CoreConfig;
use App\Traits\DataCache;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CoreConfigService implements CoreConfigServiceInterface
{
  use DataCache;

  private $coreConfig;

  public function __construct(
    CoreConfig $coreConfig
  )
  {
    $this->coreConfig = $coreConfig;
  }

  public function storeCoreConfig(array $attributes)
  {
    $this->coreConfig->fill($attributes)->save();
    return $this->coreConfig;
  }

  /**
   * @return Collection|null
   */
  public function getAllConfig(): ?Collection
  {
    if ($data = $this->getCache(CoreConfig::getCacheKey(0))) {
      return $data;
    }

    $data = $this->coreConfig->get();
    $this->setCache(CoreConfig::getCacheKey(0), $data);
    return $data;
  }

  public function getConfig(int $id)
  {
    if ($config = $this->getCache(CoreConfig::getCacheKey(1) . ':' . $id)) {
      return $config;
    }
    $config = $this->coreConfig->find($id);
    $this->setCache(CoreConfig::getCacheKey(1) . ':' . $id, $config);
    return $config;
  }

  public function updateConfig(Request $request, int $id)
  {
    /** @var CoreConfig $config */
    $config = $this->getConfig($id);
    if ($request->input('type') == 'file') {
      $file = $request->file('file');
      if (!is_dir(public_path('config'))) {
        mkdir(public_path('config'), 0777, true);
      }
      $file->move(public_path('config'), $file->getClientOriginalName());
      $config->value = "config/{$file->getClientOriginalName()}";
    } else {
      $config->fill($request->input());
    }
    $config->save();
  }

  /**
   * @param int $id
   * @return bool
   * @throws \Exception
   */
  public function deleteConfig(int $id)
  {
    /** @var CoreConfig $config */
    $config = $this->coreConfig->find($id);
    if ($config) {
      $config->delete();
      $this->removeCache(CoreConfig::getCacheKey(1) . ':' . $id);
      return true;
    }
    return false;
  }
}
