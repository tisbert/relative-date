<?php

namespace Kirby\Plugins\distantnative\relativeDate;

use DateTime;

class FuzzyDate extends Mode {

  // ======================================================
  //  Case-specific returns
  // ======================================================

  public function get() {
    if($this->isToday()) {
      return $this->getToday();
    } elseif($this->is1Day()) {
      return $this->get1Day();
    } elseif($this->isWeekday()) {
      return $this->getWeekday();
    } elseif($this->isWeek()) {
      return $this->getWeek();
    } elseif($this->isMonth()) {
      return $this->getMonth();
    } else {
      $mode = new PreciseDate($this->core);
      return $mode->get();
    }
  }

  protected function getToday() {
    return $this->lang->get(['fuzzy', 'today']);
  }

  protected function get1Day() {
    return $this->lang->get(['fuzzy', '1day', $this->diff->invert]);
  }

  protected function getWeekday() {
    return $this->translate(
      $this->lang->get(['fuzzy', $this->date->format('D')]),
      $this->lang->get(['phrases', $this->phrases()])
    );
  }

  protected function getWeek() {
    return $this->translate(
      $this->lang->get(['fuzzy', 'week']),
      $this->lang->get(['phrases', $this->phrases()])
    );
  }

  protected function getMonth() {
    return $this->translate(
      $this->lang->get(['fuzzy', 'month']),
      $this->lang->get(['phrases', $this->phrases()])
    );
  }


  // ======================================================
  //  Case checks
  // ======================================================

  public function isToday() {
    // same exact calendar day
    return  $this->isSupported('today') &&
            $this->diff->y === 0 &&
            $this->diff->m === 0 &&
            $this->diff->d === 0 &&
            $this->date->format('j') === $this->now->format('j');
  }

  public function is1Day() {
    //  tomorrow/yesterday
    $tomorrow  = $this->date($this->value)->modify('+1 day');
    $yesterday = $this->date($this->value)->modify('-1 day');

    return $this->isSupported('1day') &&
           $this->diff->y === 0 &&
           $this->diff->m === 0 &&
           $this->diff->d <= 1 &&
           ($tomorrow->format('j')  === $this->now->format('j') ||
            $yesterday->format('j') === $this->now->format('j'));
  }

  public function isWeekday() {
    return $this->isSupported('Mon') &&
           $this->isSupported('last', 'phrases') &&
           $this->diff->y === 0 &&
           $this->diff->m === 0 &&
           $this->diff->d >= 1 &&
           $this->diff->d < 7;
  }

  public function isWeek() {
    // (last/next) week (nur +/-1 calendar week)
    $next = $this->date($this->value)->modify('+1 week');
    $last = $this->date($this->value)->modify('-1 week');
    return  $this->isSupported('week') &&
            $this->isSupported('last', 'phrases') &&
            $this->diff->y === 0 &&
            $this->diff->m === 0 &&
            ($next->format('W') === $this->now->format('W') ||
             $last->format('W') === $this->now->format('W'));
  }

  public function isMonth() {
    // (last/next) month (+/-1 calendar month)
    $next = $this->date($this->value)->modify('+1 month');
    $last = $this->date($this->value)->modify('-1 month');
    return  $this->isSupported('month') &&
            $this->isSupported('last', 'phrases') &&
            $this->diff->y === 0 &&
            $this->diff->m <= 1 &&
            $this->diff->d <= 15 &&
            ($next->format('n') === $this->now->format('n') ||
             $last->format('n') === $this->now->format('n'));
  }


  // ======================================================
  //  Fill in translations
  // ======================================================

  protected function translate($references, $phrases) {

    // multiple phrases (e.g. different genders)
    if(is_array($phrases)) {
      // reference specifies which phrase to take
      if(is_array($references)) {
        $reference = $references[0];
        $phrase    = $phrases[$reference[1]];
      // fallback to first phrase
      } else {
        $reference = $references;
        $phrase    = $phrases[0];
      }

    // only one phrase
    } else {
      // multiple references
      if (is_array($references)) {
        $reference = $references[$this->diff->invert];
        $phrase    = $phrases;
      } else {
        $reference = $references;
        $phrase    = $phrases;
      }
    }

    return str_ireplace('|:reference|', $reference, $phrase);
  }


  // ======================================================
  //  Language Helpers
  // ======================================================

  protected function phrases() {
    return $this->lang->phrases($this->diff->invert + 2);
  }

  protected function isSupported($key, $base = 'fuzzy') {
    return $this->lang->supports($key, $base);
  }

}
