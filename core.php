<?php

/**
 *
 */

class relativeTimeDate {

  protected $raw         = null;
  protected $date        = null;
  protected $now         = null;
  protected $difference  = null;

  protected $length      = 7;
  protected $language    = array();

  protected $isFuzzy      = false;
  protected $phrasesKeys  = array();

  public function __construct($date, $args) {
    $this->raw          = $date;
    $this->date         = new DateTime($this->raw);
    $this->now          = new DateTime();
    $this->difference   = $this->now->diff($this->date);

    $this->language     = $this->setLanguage($args['lang']);

    $this->phrasesKeys  = array_keys($this->language['phrases']);
    $this->isFuzzy      = ($args['fuzzy'] and array_key_exists('fuzzy', $this->language)) ? true : false;
  }

  /**
   * Returns the converted relative time and date difference
   * @param  [int] $length [description]
   * @return [string]         [description]
   */
  public function get($length = null) {

    if (isset($length)) $this->length = $length;
    if ($this->length == 0) return;

    // fuzzy expressions
    if ($this->isFuzzy)
      return $this->getFuzzyExpressions();

    // normal expressions
    else
      return $this->getStatement();

  }


  protected function getStatement() {
    $statement  = "";
    $elements   = array();

    // years
    if ($this->difference->y > 0)
      array_push($elements, array($this->difference->y, $this->language['y']));
    // months
    if ($this->difference->m > 0)
      array_push($elements, array($this->difference->m, $this->language['m']));
    // weeks
    $weeks = intval($this->difference->d/7);
    if ($weeks > 0)
      array_push($elements, array($weeks, $this->language['w']));
    // days
    $days = $this->difference->d - ($weeks * 7);
    if ($days > 0)
      array_push($elements, array($days, $this->language['d']));
    // hours
    if ($this->difference->h > 0)
      array_push($elements, array($this->difference->h, $this->language['h']));
    // minutes
    if ($this->difference->i > 0)
      array_push($elements, array($this->difference->i, $this->language['min']));
    // seconds
    if ($this->difference->s > 0)
      array_push($elements, array($this->difference->s, $this->language['sec']));


    for ($part = 0; $part < $this->length; $part++) {
      $statement .= $this->getTerm($elements[$part]);
    }

    $phrase = $this->language['phrases'][$this->phrasesKeys[$this->difference->invert]];
    return str_replace('|:phrase|', $statement, $phrase);
  }


  protected function getTerm($element) {
    $count = $element[0];
    $terms = $element[1];

    // only has one form
    if (count($terms) == 1) {
      $string = $terms[0] . " ";

    // simple singular/plural
    } elseif (count($terms) == 2 and !is_array($terms[1])) {
      if ($count > 1) $string = $terms[1] . " ";
      else            $string = $terms[0] . " ";

    // plurals with specific rules
    } else {
      foreach ($terms as $term) {
        if (is_array($term)) {
          $condition = 'return ' . str_replace('|:n|', $count, $term[0]) . ';';
          if (eval($condition)) {
            $string = $term[1] . " ";
          }
        }
      }
    }

    return str_replace('|:count|', $count, $string);
  }


  /**
   * [fuzzyExpressions description]
   * @return [type] [description]
   */
  protected function getFuzzyExpressions() {

    // today (at least 5 h difference but same exact calendar day)
    if ($this->isFuzzyToday())
      return $this->language['fuzzy']['today'];

    //  tomorrow/yesterday
    if ($this->isFuzzy1Day())
      return $this->language['fuzzy']['1day'][$this->difference->invert];

    // (last/next) WEEKDAY (up till 6 days difference)
    if ($this->isFuzzyWeekday())
      return $this->getPhrase($this->language['fuzzy'][$this->date->format('D')],
                              $this->language['phrases'][$this->phrasesKeys[$this->difference->invert + 2]]);

    // (last/next) week (nur +/-1 calendar week)
    if ($this->isFuzzyWeek())
      return $this->getPhrase($this->language['fuzzy']['week'],
                              $this->language['phrases'][$this->phrasesKeys[$this->difference->invert + 2]]);

    // (last/next) month (+/-1 calendar month)
    if ($this->isFuzzyMonth())
      return $this->getPhrase($this->language['fuzzy']['month'],
                              $this->language['phrases'][$this->phrasesKeys[$this->difference->invert + 2]]);
  }

  protected function getPhrase($reference, $phrase) {
    // different forms, e.g. male and female endings
    if(is_array($phrase)) {
      if (is_array($reference)) {
        return str_replace('|:reference|', $reference[0], $phrase[$reference[1]]);
      } else {
        return str_replace('|:reference|', $reference, $phrase[0]);
      }
    } else {
      return str_replace('|:reference|', $reference, $phrase);
    }

  }

  protected function isFuzzyToday() {
    return array_key_exists('today', $this->language['fuzzy']) and
           $this->difference->y == 0 and
           $this->difference->m == 0 and
           $this->difference->d == 0 and
           $this->difference->h >= 5 and
           $this->date->format('j') == $this->now->format('j');
  }

  protected function isFuzzy1Day() {
    $next   = new DateTime($this->raw);
    $next   = $next->modify('+1 day');
    $before = new DateTime($this->raw);
    $before = $before->modify('-1 day');
    return array_key_exists('1day', $this->language['fuzzy']) and
           $this->difference->y == 0 and
           $this->difference->m == 0 and
           $this->difference->d <= 2 and
           (
             $next->format('j')   == $this->now->format('j') or
             $before->format('j') == $this->now->format('j')
           );
  }

  protected function isFuzzyWeekday() {
    return array_key_exists('Mon',  $this->language['fuzzy']) and
           array_key_exists('last', $this->language['phrases']) and
           $this->difference->y == 0 and
           $this->difference->m == 0 and
           $this->difference->d >= 1 and
           $this->difference->d < 7;
  }

  protected function isFuzzyWeek() {
    $next   = new DateTime($this->raw);
    $next   = $next->modify('+1 week');
    $before = new DateTime($this->raw);
    $before = $before->modify('-1 week');
    return array_key_exists('week', $this->language['fuzzy']) and
           array_key_exists('last', $this->language['phrases']) and
           $this->difference->y == 0 and
           $this->difference->m == 0 and
           (
             $next->format('W')   == $this->now->format('W') or
             $before->format('W') == $this->now->format('W')
           );
  }

  protected function isFuzzyMonth() {
    $next   = new DateTime($this->raw);
    $next   = $next->modify('+1 month');
    $before = new DateTime($this->raw);
    $before = $before->modify('-1 month');
    return array_key_exists('month', $this->language['fuzzy']) and
           array_key_exists('last',  $this->language['phrases']) and
           $this->difference->y == 0 and
           (
             $next->format('n')   == $this->now->format('n') or
             $before->format('n') == $this->now->format('n')
           );
  }


  protected function setLanguage($locale) {
    // fallback if selected language is not supported
    if (!file_exists(__DIR__.'/lang/'.$locale.'.php'))
        $locale = c::get('relativedate.default', 'en');

    return require 'lang/'.$locale.'.php';
  }


}
