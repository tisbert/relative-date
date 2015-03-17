<?php

return array(
    'sec'   => array('1 segundo', '|:count| segundos'),
    'min'   => array('1 minuto',  '|:count| minutos'),
    'h'     => array('1 hora',    '|:count| horas'),
    'd'     => array('1 dia',     '|:count| dias'),
    'w'     => array('1 semana',  '|:count| semanas'),
    'm'     => array('1 mês',     '|:count| meses'),
    'y'     => array('1 ano',     '|:count| anos'),
    'meta'  => array(
                'after_now'     => 'dentro de |:phrase|',
                'before_now'    => 'a |:phrase|'
                'next'          => 'próximo/a |:reference|',
                'last'          => 'último/a |:reference|',
                ),

    'fuzzy' => array(
                'today' => 'hoje',
                '1day'  => array('amanhã','ontem'),

                'Mon'   => 'Segunda-feira',
                'Tue'   => 'Terça-feira',
                'Wed'   => 'Quarta-feira',
                'Thu'   => 'Quinta-feira',
                'Fri'   => 'Sexta-feira',
                'Sat'   => 'Sábado',
                'Sun'   => 'Domingo',

                'week'  => 'semana',
                'month' => 'mês',
                ),

    'supports' => 1.0,
    'author'   => 'rhawbert (https://github.com/rhawbert)'
    );


