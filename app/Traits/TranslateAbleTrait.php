<?php

namespace App\Traits;

use App\Events\SaveTranslationEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait TranslateAbleTrait
{
  protected static $data = [];
  protected $translatePrefix = 'translates';
  protected $translateTable = [
    'text',
    'string',
    'date',
  ];

  public function getTranslation(string $attribute, string $locale = 'vn')
  {
    $model = $this->getModelFullName();
    if ($this->isValidTranslate($attribute)) {
      $fieldType = $this->translate[$attribute];
      if ($this->isValidFieldTranslate($fieldType)) {
        $instanceName = "{$fieldType}_{$this->translatePrefix}";
        /** @var Model $instance */
        $instance = new $instanceName;
        $value = $instance->where('model', $model)->where('lang', $locale)->where('model_id', $this->id)->first();
        return optional($value)->value;
      }
      throw new \Exception("{$fieldType} is not valid");
    }
    throw new \Exception("{$attribute} is not exists in {$model}");
  }

  public function setTranslation(string $attribute, string $value, string $locale = 'vn'): self
  {
    $fieldType = $this->translate[$attribute];
    if ($this->isValidFieldTranslate($fieldType)) {
      static::$data[] = [
        'field_name' => $attribute,
        'value' => $value,
        'model' => $this->getModelFullName(),
        'model_id' => null,
        'lang' => $locale,
        'field_type' => $fieldType,
      ];
    }
    return $this;
  }

  private function isValidTranslate(string $attribute)
  {
    return isset($this->translate[$attribute]);
  }

  private function isValidFieldTranslate(string $fieldType)
  {
    return in_array($fieldType, $this->translateTable);
  }

  /**
   * return full model name ( with namespace and class name )
   *
   * @return string
   */
  protected function getModelFullName(): string
  {
    return static::class;
  }
}
