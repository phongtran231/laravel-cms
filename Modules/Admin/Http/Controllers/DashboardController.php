<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\CoreConfig;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\Admin\Services\CoreConfig\CoreConfigServiceInterface;

class DashboardController extends Controller
{
  private $coreConfigService;

  public function __construct(
    CoreConfigServiceInterface $coreConfigService
  )
  {
    $this->coreConfigService = $coreConfigService;
  }

  public function index(): View
  {
    $coreConfigs = $this->coreConfigService->getAllConfig();
    $texts = $coreConfigs->filter(function (CoreConfig $coreConfig) {
      return $coreConfig->type == 'text';
    });
    $files = $coreConfigs->filter(function (CoreConfig $coreConfig) {
      return $coreConfig->type == 'file';
    });
    return view('admin::dashboard.index', compact('coreConfigs', 'texts', 'files'));
  }
}
