<?php

return array(
    'sec'   => array('1 Sekunde', '|:count| Sekunden'),
    'min'   => array('1 Minute',  '|:count| Minuten'),
    'h'     => array('1 Stunde',  '|:count| Stunden'),
    'd'     => array('1 Tag',     '|:count| Tagen'),
    'w'     => array('1 Woche',   '|:count| Wochen'),
    'm'     => array('1 Monat',   '|:count| Monaten'),
    'y'     => array('1 Jahr',    '|:count| Jahren'),

    'meta'  => array(
                'after_now'     => 'in |:phrase|',
                'before_now'    => 'vor |:phrase|',
                'next'          => 'nächste|:reference|',
                'last'          => 'letzte|:reference|',
                ),

    'fuzzy' => array(
                'today' => 'heute',
                '1day'  => array('morgen','gestern'),

                'Mon'   => 'r Montag',
                'Tue'   => 'r Dienstag',
                'Wed'   => 'r Mittwoch',
                'Thu'   => 'r Donnerstag',
                'Fri'   => 'r Freitag',
                'Sat'   => 'r Samstag',
                'Sun'   => 'r Sonntag',

                'week'  => ' Woche',
                'month' => 'r Monat',
                ),

    'supports' => 1.0,
    'author'   => 'distantnative (https://github.com/distantnative)'
    );
