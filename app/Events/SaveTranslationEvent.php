<?php

namespace App\Events;

use Illuminate\Support\Str;

class SaveTranslationEvent
{
  public $model;
  public function __construct($model)
  {
    logger()->info(var_export($model, true));
    $instanceClass = Str::studly("text_translate");
    $instanceClass = "\App\Models\\$instanceClass";
    $instance = new $instanceClass;
    $instance->model_id = 1;
//    $instance->model = get_class($model);
    $instance->field_name = 'content';
//    $instance->value = $model->value;
    $instance->save();
  }
}
