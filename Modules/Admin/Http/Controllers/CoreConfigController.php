<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Modules\Admin\Services\CoreConfig\CoreConfigServiceInterface;
use Symfony\Component\HttpFoundation\Response;

class CoreConfigController extends AbstractController
{
  private $coreConfigService;

  public function __construct(CoreConfigServiceInterface $coreConfigService)
  {
    $this->coreConfigService = $coreConfigService;
  }

  public function store(Request $request)
  {
    try {
      $rules = [
        'name' => 'required',
        'type' => ['required', 'in:text,file']
      ];
      $messages = [
        'name.required' => __('backend/core_config.name_required'),
        'type.required' => __('backend/core_config.type_required'),
        'type.in' => __('backend/core_config.type_in')
      ];
      $this->validate($request, $rules, $messages);
      $this->coreConfigService->storeCoreConfig($request->input());
      return redirect()->back();
    } catch (ValidationException $e) {
      return redirect()->back()->withErrors($e->validator->getMessageBag());
    }
  }

  public function update(Request $request, int $id)
  {
    if ($request->input('type') == 'file') {
      try {
        $rules = [
          'file' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ];
        $messages = [
          'file.image' => __('backend/core_config.file_image'),
          'file.mimes' => __('backend/core_config.file_mimes'),
        ];
        $this->validate($request, $rules, $messages);
      } catch (ValidationException $e) {
        return redirect()->back()->withErrors($e->validator->getMessageBag());
      }
    }
    $this->coreConfigService->updateConfig($request, $id);
    return redirect()->back();
  }

  public function destroy(Request $request, int $id)
  {
    if ($request->ajax()) {
      $res = $this->coreConfigService->deleteConfig($id);
      if ($res) {
        return response()->json([
          'message' => __('backend/core_config.delete_success'),
        ], Response::HTTP_OK);
      }
      return response()->json([
        'message' => __('backend/core_config.delete_fail'),
      ], Response::HTTP_BAD_REQUEST);
    }
  }
}
