<?php

return array(
        'sec'   => array('1 seconde', '|:count| secondes'),
        'min'   => array('1 minute',  '|:count| minutes'),
        'h'     => array('1 heure',   '|:count| heures'),
        'd'     => array('1 jour',    '|:count| jours'),
        'w'     => array('1 semaine', '|:count| semaines'),
        'm'     => array(             '|:count| mois'),
        'y'     => array('1 an',      '|:count| ans'),
        'meta'  => array(
                    'after_now'     => 'dans |:phrase|',
                    'before_now'    => 'il y a |:phrase|',
                    'next'          => '|:reference| prochain/e',
                    'last'          => '|:reference| dernièr/e',
                    ),

        'fuzzy' => array(
                    'today' => 'aujourd\'hui',
                    '1day'  => array('demain','hier'),

                    'Mon'   => 'lundi',
                    'Tue'   => 'mardi',
                    'Wed'   => 'mercredi',
                    'Thu'   => 'jeudi',
                    'Fri'   => 'vendredi',
                    'Sat'   => 'samedi',
                    'Sun'   => 'dimanche',

                    'week'  => 'la semaine',
                    'month' => 'le mois',
                    ),

        'supports' => 1.0
        );
