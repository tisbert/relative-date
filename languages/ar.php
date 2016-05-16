<?php

// ==================================================================
//  Language: Arabic [ar]
//  ----
//  Author:   distantnative <nico@getkirby.com>
//  Version:  1.0
//  Supports: 1.5
// ==================================================================

$rules = [
  '|:n| == 0',
  '|:n| == 1',
  '|:n| == 2',
  '|:n|%100 >= 3 and |:n|%100 <= 10',
  '|:n|%100 >= 11',
  'true'
];

return [
  'phrases'  => [
    'after_now'   => 'من الآن |:phrase|',
    'before_now'  => 'منذ |:phrase|',
    // 'next'      => 'next |:reference|',
    // 'last'      => 'last |:reference|',
  ],

  'sec' => [
    [$rules[0], 'ثانية'],
    [$rules[1], 'ثانية'],
    [$rules[2], 'ثانيتين'],
    // [$rules[3], '|:count| '],
    // [$rules[4], '|:count| '],
    [$rules[5], '|:count| ثوان'],
  ],
  'min' => [
    [$rules[0], 'دقيقة'],
    [$rules[1], 'دقيقة'],
    [$rules[2], 'دقيقتين'],
    // [$rules[3], '|:count| '],
    // [$rules[4], '|:count| '],
    [$rules[5], '|:count| دقائق'],
  ],
  'h'   => [
    [$rules[0], 'ساعة'],
    [$rules[1], 'ساعة'],
    [$rules[2], 'ساعتين'],
    // [$rules[3], '|:count| '],
    // [$rules[4], '|:count| '],
    [$rules[5], '|:count| ساعات'],
  ],
  'd'   => [
    [$rules[0], 'يوم'],
    [$rules[1], 'يوم'],
    [$rules[2], 'يومين'],
    // [$rules[3], '|:count| '],
    // [$rules[4], '|:count| '],
    [$rules[5], '|:count| أيام'],
  ],
  'w'   => [
    [$rules[0], 'أسبوع'],
    [$rules[1], 'أسبوع'],
    [$rules[2], 'أسبوعين'],
    // [$rules[3], '|:count| '],
    // [$rules[4], '|:count| '],
    [$rules[5], '|:count| أسابيع'],
  ],
  'm'   => [
    [$rules[0], 'شهر'],
    [$rules[1], 'شهر'],
    [$rules[2], 'شهرين'],
    // [$rules[3], '|:count| '],
    // [$rules[4], '|:count| '],
    [$rules[5], '|:count| شهور / أشهر'],
  ],
  'y'   => [
    [$rules[0], 'سنة'],
    [$rules[1], 'سنة'],
    [$rules[2], 'سنتين'],
    // [$rules[3], '|:count| '],
    // [$rules[4], '|:count| '],
    [$rules[5], '|:count| سنوات / سنين'],
  ],

  /*
  'fuzzy' => [
    'today' => 'today',
    '1day'  => ['tomorrow','yesterday'],

    'Mon'   => 'Monday',
    'Tue'   => 'Tuesday',
    'Wed'   => 'Wednesday',
    'Thu'   => 'Thursday',
    'Fri'   => 'Friday',
    'Sat'   => 'Saturday',
    'Sun'   => 'Sunday',

    'week'  => 'week',
    'month' => 'month',
  ],
  */
];
