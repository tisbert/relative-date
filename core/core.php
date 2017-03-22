<?php

namespace Kirby\RelativeDate;


use Carbon\Carbon;

class Core {

  protected $carbon;

  public function __construct($date) {
    $this->carbon = new Carbon($date);
    Carbon::setLocale(site()->locale());
  }

  public function __call($name, $args) {
    return $this->carbon->{$name}($args);
  }

  public function __toString() {
    return $this->carbon->diffForHumans();
  }

}
