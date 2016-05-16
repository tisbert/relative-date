<?php

require_once('core/core.php');

// ======================================================
//  Helper function relativeDate($value, $args)
// ======================================================

function relativeDate($value, $args = []) {
  $core = 'Kirby\Plugins\distantnative\relativeDate\Core';

  if($core::isTimestamp($value)) {
    $value = date(DATE_ATOM, $value);
  }

  $date   = new $core($value, $args);
  $result = $date->get();

  if($result === $value){
    $value  = new Datetime($value);
    $result = $value->format($date->option('format'));
  }

  return $result;
}

// ======================================================
// Field method '->relative($lang|$length)'
// ======================================================

$kirby->set('field::method', 'relativeDate', function($field, $args = []) {
  if(is_string($args)) {
    $args = ['lang' => $args];
  } elseif (is_int($args)) {
    $args = ['length' => $args];
  }

  $field->value = relativeDate($field->value, $args);
  return $field;
});


// ======================================================
// Kirbytext tag '(relativeDate: $date)'
// ======================================================

$options = [
  'lang'      => 'string',
  'length'    => 'int',
  'threshold' => 'int',
  'fuzzy'     => 'bool',
  'format'    => 'string',
];

$kirby->set('tag', 'relativeDate', [
  'attr' => array_keys($options),
  'html' => function($tag) use($options) {
    $args = [];

    foreach($options as $option => $mode) {
      if($mode === 'bool') {
        if($tag->attr($option) === 'true')  $args[$option] = true;
        if($tag->attr($option) === 'false') $args[$option] = false;
      } elseif($mode === 'ing') {
        $args['option'] = (int)$tag->attr($option);
      } elseif($mode === 'string') {
        $args['option'] = $tag->attr($option);
      }
    }

    return oembed($tag->attr('oembed'), $args);
  }
]);
