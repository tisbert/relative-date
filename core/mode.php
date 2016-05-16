<?php

namespace Kirby\Plugins\distantnative\relativeDate;

use DateTime;

class Mode {

  public function __construct($core) {
    $this->core  = $core;
    $this->value = $this->core->value;
    $this->date  = $this->date($this->value);
    $this->now   = $this->date();
    $this->diff  = $this->now->diff($this->date);

    $this->lang  = $core->language;
  }

  protected function date($value = null) {
    return new DateTime($value);
  }

  protected function option($option) {
    return $this->core->option($option);
  }

}
