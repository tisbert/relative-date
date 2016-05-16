<?php

namespace Kirby\Plugins\distantnative\relativeDate;

use C;

class PreciseDate extends Mode {


  // ======================================================
  //  get
  // ======================================================

  public function get() {
    $parts     = array_slice($this->parts(), 0, $this->option('length'));
    $statement = implode($this->glue(), $parts);

    $phrase = $this->lang->get(['phrases', $this->lang->phrases($this->diff->invert)]);
    return str_ireplace('|:phrase|', $statement, $phrase);
  }


  // ======================================================
  //  Collect parts
  // ======================================================

  protected function parts() {
    $parts = [];

    // Years
    if ($this->diff->y > 0) {
      $parts[] = [$this->diff->y, $this->lang->get('y')];
    }

    // months
    if ($this->diff->m > 0) {
      $parts[] = [$this->diff->m, $this->lang->get('m')];
    }

    // Weeks
    $weeks = intval($this->diff->d / 7);
    if ($weeks > 0) {
      $parts[] = [$weeks, $this->lang->get('w')];
    }

    // Days
    $days = $this->diff->d - ($weeks * 7);
    if ($days > 0) {
      $parts[] = [$days, $this->lang->get('d')];
    }

    // Hours
    if ($this->diff->h > 0) {
      $parts[] = [$this->diff->h, $this->lang->get('h')];
    }

    // Minutes
    if ($this->diff->i > 0) {
      $parts[] = [$this->diff->i, $this->lang->get('min')];
    }

    // Seconds
    if ($this->diff->s > 0 || count($parts) === 0) {
      $parts[] = [$this->diff->s, $this->lang->get('sec')];
    }

    return array_map([$this, 'translate'], $parts);
  }


  // ======================================================
  //  Translate
  // ======================================================

  protected function translate($unit) {
    $count = $unit[0];
    $terms = $unit[1];

    // only has one form
    if(count($terms) === 1) {
      $string = $terms[0];

    // simple singular/plural
    } elseif(count($terms) == 2 and !is_array($terms[1])) {
      if ($count > 1) $string = $terms[1];
      else            $string = $terms[0];

    // plurals with specific rules
    } else {
      foreach ($terms as $term) {
        if (is_array($term)) {
          $condition = 'return ' . str_replace('|:n|', $count, $term[0]) . ';';
          if (eval($condition)) {
            $string = $term[1];
          }
        }
      }
    }
    return str_ireplace('|:count|', $count, $string);
  }


  // ======================================================
  //  Glue/Conjunctions
  // ======================================================

  protected function glue() {
    $glue = c::get('plugin.relativeDate.conjunction', false);

    if($glue === false)  return ' ';
    if(is_string($glue)) return ' ' . $glue . ' ';

    if($this->lang->supports('and', 'phrases')) {
      return ' ' . $this->lang->get(['phrases', 'and']) . ' ';
    } else {
      return ' ';
    }
  }

}
