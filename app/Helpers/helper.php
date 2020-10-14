<?php

use App\Models\Post;
use App\Models\MainCategory;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

if (!function_exists('_backend_assets')) {
  /**
   * get assets from backend
   * @param $assetUrl
   * @return string
   */
  function _backend_assets(string $assetUrl): string
  {
    return asset('backend/' . $assetUrl);
  }
}

if (!function_exists('_get_all_posts_from_main_category')) {
  /**
   * @param MainCategory|string|int $category
   * @return Collection
   */
  function _get_all_posts_from_main_category($category): Collection {
    if ($category instanceof MainCategory) {
      return $category->all_posts();
    }
    if (is_string($category) || is_int($category)) {
      /** @var MainCategory $c */
      if (is_string($category)) {
        $c = MainCategory::where('cat_name', $category)->first();
      }
      if (is_int($category)) {
        $c = MainCategory::find($category);
      }
      if ($c) {
        return $c->all_posts();
      }
    }
    return new Collection([]);
  }
}

if (!function_exists('_get_post_detail')) {
  /**
   * get post detail by slug or id
   * @param string|int $param
   * @return null|mixed
   */
  function _get_post_detail($param)
  {
    if (is_string($param)) {
      return Post::where('slug', $param)->first();
    }
    if (is_int($param)) {
      return Post::find($param);
    }
    return null;
  }
}

if (!function_exists('_get_posts_with_paginate')) {
  /**
   * @param int $perPage
   * @return LengthAwarePaginator
   */
  function _get_posts_with_paginate(int $perPage = 20): LengthAwarePaginator
  {
    return Post::paginate($perPage);
  }
}

if (!function_exists('_get_all_posts')) {
  /**
   * @param bool|null $all
   * @return Collection
   */
  function _get_all_posts(?bool $all = false): Collection
  {
    if ($all) {
      return Post::all();
    } else {
      return Post::whereActive(true)->get();
    }
  }
}

if (!function_exists('_get_main_category_detail')) {
  /**
   * get main category detail by cat_name or slug or id
   * @param string|int $param
   * @param array|null $with
   * @return mixed
   */
  function _get_main_category_detail($param, ?array $with)
  {
    if (is_string($param)) {
      return MainCategory::when($with, function (Builder $builder) use ($with) {
        $builder->with($with);
      })->where(function (Builder $builder) use ($param) {
        $builder->where('cat_name', $param)->orWhere('slug', $param);
      })->first();
    }
    if (is_int($param)) {
      return MainCategory::when($with, function (Builder $builder) use ($with) {
        $builder->with($with);
      })->find($param);
    }
  }
}

if (!function_exists('_get_all_main_categories')) {
  /**
   * @param bool $all
   * @param array $orderBy
   * @return Collection
   */
  function _get_all_main_categories(bool $all = false, array $orderBy = null): Collection
  {
    if ($all) {
      return MainCategory::when($orderBy, function (Builder $builder) use ($orderBy) {
        $orderBy = collect($orderBy)->collapse();
        $orderBy->each(function ($order, $key) use ($builder) {
          $builder->orderBy($key, $order);
        });
      })->get();
    } else {
      return MainCategory::when($orderBy, function (Builder $builder) use ($orderBy) {
        $orderBy = collect($orderBy)->collapse();
        $orderBy->each(function ($order, $key) use ($builder) {
          $builder->orderBy($key, $order);
        });
      })->whereActive(true)->get();
    }
  }
}

if (!function_exists('_get_sub_category_detail')) {
  /**
   * get sub category detail by cat_name or slug or id
   * @param string|int $param
   * @param array|null $with
   * @return mixed
   */
  function _get_sub_category_detail($param, ?array $with)
  {
    if (is_string($param)) {
      return SubCategory::when($with, function (Builder $builder) use ($with) {
        $builder->with($with);
      })->where(function (Builder $builder) use ($param) {
        $builder->where('cat_name', $param)->orWhere('slug', $param);
      })->first();
    }
    if (is_int($param)) {
      return SubCategory::when($with, function (Builder $builder) use ($with) {
        $builder->with($with);
      })->find($param);
    }
  }
}

if (!function_exists('_get_all_sub_categories')) {
  /**
   * @param bool $all
   * @param array|null $orderBy
   * @return Collection
   */
  function _get_all_sub_categories(bool $all = false, array $orderBy = null): Collection
  {
    if ($all) {
      return SubCategory::when($orderBy, function (Builder $builder) use ($orderBy) {
        $orderBy = collect($orderBy)->collapse();
        $orderBy->each(function ($order, $key) use ($builder) {
          $builder->orderBy($key, $order);
        });
      })->get();
    } else {
      return SubCategory::when($orderBy, function (Builder $builder) use ($orderBy) {
        $orderBy = collect($orderBy)->collapse();
        $orderBy->each(function ($order, $key) use ($builder) {
          $builder->orderBy($key, $order);
        });
      })->whereActive(true)->get();
    }
  }
}

if (!function_exists('_get_from_cache')) {
  /**
   * @param string $table
   * @param string $primaryKey
   * @return mixed|null
   */
  function _get_from_cache(string $table, string $primaryKey)
  {
    return \App\Traits\ModelCacheAbleTrait::getCache($table, $primaryKey);
  }
}
