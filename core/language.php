<?php

namespace Kirby\Plugins\distantnative\relativeDate;

use C;
use F;

class Language {

  public $language = [];

  public function __construct($locale) {
    $dir = dirname(__DIR__) . DS . 'languages' . DS;
    if(!f::exists($dir . $locale . '.php')) {
      $locale = c::get('plugin.relativeDate.default', 'en');
    }

    return $this->language = require($dir . $locale . '.php');
  }


  public function get($keys = []) {
    $return = $this->language;

    if(!is_array($keys)) $keys = [$keys];

    foreach($keys as $key) {
      $return = $return[$key];
    }

    return $return;
  }

  public function supports($key, $subarray = null) {
    return array_key_exists($key, $subarray ? $this->language[$subarray] : $this->language);
  }

  public function phrases($index = null) {
    $phrases = array_keys($this->language['phrases']);

    if($index) {
      return $phrases[$index];
    } else {
      return $phrases;
    }
  }

}
