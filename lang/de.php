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
                'before_now'    => 'vor |:phrase|'
                ),


    'fuzzy' => array(
            'after_now' => array(
                ),
            'before_now' => array(
                'gestern' => '/^(1 Tag(.*)|[1-2]?[1-9] Stunde(n)?(.*))/',
                ),
            )
    );
