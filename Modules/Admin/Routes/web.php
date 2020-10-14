<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
  Route::match(['GET', "POST"], 'login','LoginController@login')->name('admin.login');
});

Route::prefix('admin')->middleware(['auth:admin'])->group(function() {
  Route::get('/', 'DashboardController@index')->name('admin.dashboard');

  Route::group([
    'prefix' => 'core-config',
  ], function () {
    Route::post('', 'CoreConfigController@store')->name('admin.core-config.store');
    Route::put('{id}', 'CoreConfigController@update')->name('admin.core-config.update');
    Route::delete('{id}', 'CoreConfigController@destroy')->name('admin.core-config.delete');
  });

  Route::group([
    'prefix' => 'main-category',
  ], function () {
    Route::get('/', 'MainCategoryController@index')->name('admin.main-category.index');
    Route::get('{id}', 'MainCategoryController@edit')->name('admin.main-category.edit');
  });
});
