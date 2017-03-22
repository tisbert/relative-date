<?php

require 'vendor/autoload.php';
require 'core/core.php';


$kirby->set('tag', 'relativeDate', [
  'html' => function($tag) {
    return relativeDate($tag->attr('relativedate'));
  }
]);

$kirby->set('field::method', 'relativeDate', function($field) {
  return relativeDate($field->value);
});

function relativeDate($date) {
  return new Kirby\RelativeDate\Core($date);
}
