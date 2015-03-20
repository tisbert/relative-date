<?php

return array(
        'sec'   => array('1 segundo', '|:count| segundos'),
        'min'   => array('1 minuto',  '|:count| minutos'),
        'h'     => array('1 hora',    '|:count| horas'),
        'd'     => array('1 día',     '|:count| días'),
        'w'     => array('1 semana',  '|:count| semanas'),
        'm'     => array('1 mes',     '|:count| meses'),
        'y'     => array('1 año',     '|:count| años'),
        'meta'  => array(
                    'after_now'     => 'dentro de |:phrase|',
                    'before_now'    => 'hace |:phrase|',
                    'next'          => '|:reference| próximo/a',
                    'last'          => '|:reference| pasado/a',
                    ),

        'fuzzy' => array(
                    'today' => 'hoy',
                    '1day'  => array('mañana','ayer'),

                    'Mon'   => 'lunes',
                    'Tue'   => 'martes',
                    'Wed'   => 'miércoles',
                    'Thu'   => 'jueves',
                    'Fri'   => 'viernes',
                    'Sat'   => 'sábado',
                    'Sun'   => 'domingo',

                    'week'  => 'la semana',
                    'month' => 'el mes',
                    ),

        'supports' => 1.0
        );
