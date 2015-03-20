<?php

return array(
        'sec'   => array('1 segon',   '|:count| segons'),
        'min'   => array('1 minut',   '|:count| minuts'),
        'h'     => array('1 hora',    '|:count| hores'),
        'd'     => array('1 dia',     '|:count| dies'),
        'w'     => array('1 setmana', '|:count| setmanes'),
        'm'     => array('1 mes',     '|:count| mesos'),
        'y'     => array('1 any',     '|:count| anys'),
        'meta'  => array(
                    'after_now'     => 'd’aquí a |:phrase|',
                    'before_now'    => 'fa |:phrase|',
                    'next'          => '|:reference| pròxim/a',
                    'last'          => '|:reference| passat/da',
                    ),

        'fuzzy' => array(
                    'today' => 'avui',
                    '1day'  => array('demà','ahir'),

                    'Mon'   => 'dilluns',
                    'Tue'   => 'dimarts',
                    'Wed'   => 'dimecres',
                    'Thu'   => 'dijous',
                    'Fri'   => 'divendres',
                    'Sat'   => 'dissabte',
                    'Sun'   => 'diumenge',

                    'week'  => 'la setmana',
                    'month' => 'el mes',
                    ),

        'supports' => 1.0,
        'author'   => 'danielguillan (https://github.com/danielguillan)'
        );
