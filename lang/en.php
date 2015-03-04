<?php

return array(
    'sec'   => array('1 second', '|:count| seconds'),
    'min'   => array('1 minute', '|:count| minutes'),
    'h'     => array('1 hour',   '|:count| hours'),
    'd'     => array('1 day',    '|:count| days'),
    'w'     => array('1 week',   '|:count| weeks'),
    'm'     => array('1 month',  '|:count| months'),
    'y'     => array('1 year',   '|:count| years'),
    'meta'  => array(
                'after_now'     => '|:phrase| from now',
                'before_now'    => '|:phrase| ago'
                ),


    'fuzzy' => array(
            'after_now' => array(
                array('tomorrow' => '^[1-2]?[1-9] hour(s)?(.*)'),
                ),
            'before_now' => array(
                array('less than a minute ago' => '^[1-5]?[1-9] second(s)?(.*)'),
                array('yesterday' => '^[1-2]?[1-9] hour(s)?(.*)'),
                ),
            )
    );
