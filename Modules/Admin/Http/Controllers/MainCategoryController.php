<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Admin\Services\MainCategory\MainCategoryServiceInterface;
use Yajra\DataTables\Facades\DataTables;

class MainCategoryController extends AbstractController
{

  private $mainCategoryService;

  public function __construct(
    MainCategoryServiceInterface $mainCategoryService
  )
  {
    $this->mainCategoryService = $mainCategoryService;
  }

  public function index(Request $request)
  {
    $mainCategories = $this->mainCategoryService->getAllMainCategory();
    if ($request->ajax()) {
      return DataTables::of($mainCategories)->make(true);
    }
    return view('admin::main_category.index', compact('mainCategories'));
  }

  /**
   * @param int $id
   */
  public function edit(int $id)
  {
    $mainCategory = $this->mainCategoryService->getMainCategory($id);
    return view('admin::main_category.edit', compact('mainCategory'));
  }
}
