<?php

require 'core.php';


/**
 *  Field method '->relative($threshold, $gran)'
 */

field::$methods['relative'] = function($field, $args = null) {
    $defaults = array(
      'lang'      => (count(site()->languages()) >= 1) ? site()->language()->code() : c::get('relativedate.default', 'en'),
      'length'    => c::get('relativedate.length', 2),
      'threshold' => c::get('relativedate.threshold', false),
      'fuzzy'     => c::get('relativedate.fuzzy', true)
    );

    if (is_array($args))
      $args = array_merge($defaults, $args);
    elseif (is_string($args) and strlen($args) >= 2 and strlen($args) <= 5)
      $args = array_merge($defaults, array('lang' => $args));
    elseif (is_int($args))
      $args = array_merge($defaults, array('length' => $args));
    else
      $args = $defaults;

    // only convert to relative if time difference no exceeds threshold
    if ($args['threshold'] === false or
        abs(strtotime($field->value) - time()) <= $args['threshold']) {
        $relative     = new relativeTimeDate($field->value, $args);
        $field->value = $relative->get($args['length']);
    }

    return $field;
};

