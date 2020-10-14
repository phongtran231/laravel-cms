<?php

namespace Modules\Admin\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Admin\Services\CoreConfig\CoreConfigService;
use Modules\Admin\Services\CoreConfig\CoreConfigServiceInterface;
use Modules\Admin\Services\MainCategory\MainCategoryService;
use Modules\Admin\Services\MainCategory\MainCategoryServiceInterface;

class ServiceMappingProvider extends ServiceProvider
{
  public function boot()
  {
    $this->app->singleton(CoreConfigServiceInterface::class, CoreConfigService::class);
    $this->app->singleton(MainCategoryServiceInterface::class, MainCategoryService::class);
  }
}
