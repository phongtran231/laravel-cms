<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TextTranslate extends Model
{
  protected $table = "text_translates";

  public $timestamps = false;

  protected $primaryKey = null;

  protected $fillable = [
    'field_name', 'value', 'model', 'model_id', 'lang'
  ];
}
