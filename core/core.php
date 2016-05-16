<?php

namespace Kirby\Plugins\distantnative\relativeDate;

require_once('language.php');
require_once('mode.php');
require_once('fuzzy.php');
require_once('precise.php');

use C;

class Core {

  public function __construct($value, $args = []) {
    $this->value    = $value;
    $this->options  = $this->defaults($args);
    $this->language = new Language($this->option('lang'));
    $this->mode     = $this->mode();
  }

  public function get() {
    if(!$this->overThreshold() || $this->option('length') === 0) {
      return $this->mode->get();
    } else {
      return $this->value;
    }
  }

  protected function mode() {
    if($this->option('fuzzy') && $this->language->supports('fuzzy')) {
      return new FuzzyDate($this);
    } else {
      return new PreciseDate;
    }
  }

  protected function overThreshold() {
    $threshold = $this->option('threshold');

    if($threshold === false) {
      return false;
    } elseif(abs(strtotime($this->value) - time()) <= $threshold) {
      return false;
    } else {
      return true;
    }
  }

  protected function defaults($args = []) {
    $defaults = [
      'lang'      => (count(site()->languages()) >= 1) ? site()->language()->code() : null,
      'length'    => c::get('plugin.relativeDate.length', 2),
      'threshold' => c::get('plugin.relativeDate.threshold', false),
      'fuzzy'     => c::get('plugin.relativeDate.fuzzy', true),
      'format'    => c::get('plugin.relativeDate.format', 'd.m.Y')
    ];

    return array_merge($defaults, $args);
  }

  public function option($option) {
    return isset($this->options[$option]) ? $this->options[$option] : null;
  }

  public static function isTimestamp($value) {
    if(is_int($value) || is_float($value)) {
      $check = $value;
    } else {
      $check = (string)(int)$value;
    }

    return ($check === $value) && ((int)$value <=  PHP_INT_MAX) && ((int)$value >= ~PHP_INT_MAX);
  }


}
