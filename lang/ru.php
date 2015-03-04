<?php
$singular_1['sec']  = 'секунду';
$plural_24['sec']   = 'секунды';
$plural_else['sec'] = 'секунд';

$singular_1['min']  = 'минуту';
$plural_24['min']   = 'минуты';
$plural_else['min'] = 'минут';

$singular_1['h']  = 'час';
$plural_24['h']   = 'часа';
$plural_else['h'] = 'часов';

$singular_1['d']  = 'день';
$plural_24['d']   = 'дня';
$plural_else['d'] = 'дней';

$singular_1['w']  = 'неделю';
$plural_24['w']   = 'недели';
$plural_else['w'] = 'недель';

$singular_1['m']  = 'месяц';
$plural_24['m']   = 'недели';
$plural_else['m'] = 'недель';

$singular_1['y']  = 'год';
$plural_24['y']   = 'года';
$plural_else['y'] = 'лет';


return array(
    'sec'   => array(
                          '1 '       .$singular_1['sec'],
                array(4,  '|:count| '.$plural_24['sec']),
                array(20, '|:count| '.$plural_else['sec']),
                array(21, '|:count| '.$singular_1['sec']),
                array(24, '|:count| '.$plural_24['sec']),
                array(30, '|:count| '.$plural_else['sec']),
                array(31, '|:count| '.$singular_1['sec']),
                array(34, '|:count| '.$plural_24['sec']),
                array(40, '|:count| '.$plural_else['sec']),
                array(41, '|:count| '.$singular_1['sec']),
                array(44, '|:count| '.$plural_24['sec']),
                array(50, '|:count| '.$plural_else['sec']),
                array(51, '|:count| '.$singular_1['sec']),
                array(54, '|:count| '.$plural_24['sec']),
                          '|:count| '.$plural_else['sec']),
    'min'   => array(
                          '1 '       .$singular_1['min'],
                array(4,  '|:count| '.$plural_24['min']),
                array(20, '|:count| '.$plural_else['min']),
                array(21, '|:count| '.$singular_1['min']),
                array(24, '|:count| '.$plural_24['min']),
                array(30, '|:count| '.$plural_else['min']),
                array(31, '|:count| '.$singular_1['min']),
                array(34, '|:count| '.$plural_24['min']),
                array(40, '|:count| '.$plural_else['min']),
                array(41, '|:count| '.$singular_1['min']),
                array(44, '|:count| '.$plural_24['min']),
                array(50, '|:count| '.$plural_else['min']),
                array(51, '|:count| '.$singular_1['min']),
                array(54, '|:count| '.$plural_24['min']),
                          '|:count| '.$plural_else['min']),
    'h'     => array(
                          '1 '       .$singular_1['h'],
                array(4,  '|:count| '.$plural_24['h']),
                array(20, '|:count| '.$plural_else['h']),
                array(21, '|:count| '.$singular_1['h']),
                          '|:count| '.$plural_24['h']),
    'd'     => array(
                          '1 '       .$singular_1['d'],
                array(4,  '|:count| '.$plural_24['d']),
                          '|:count| '.$plural_else['d']),
    'w'     => array(
                          '1 '       .$singular_1['w'],
                array(4,  '|:count| '.$plural_24['w']),
                          '|:count| '.$plural_else['w']),
    'm'     => array(
                          '1 '       .$singular_1['m'],
                array(4,  '|:count| '.$plural_24['m']),
                          '|:count| '.$plural_else['m']),
    'y'     => array(
                          '1 '       .$singular_1['y'],
                array(4,  '|:count| '.$plural_24['y']),
                array(20, '|:count| '.$plural_else['y']),
                array(21, '|:count| '.$singular_1['y']),
                array(24, '|:count| '.$plural_24['y']),
                array(30, '|:count| '.$plural_else['y']),
                array(31, '|:count| '.$singular_1['y']),
                array(34, '|:count| '.$plural_24['y']),
                array(40, '|:count| '.$plural_else['y']),
                array(41, '|:count| '.$singular_1['y']),
                array(44, '|:count| '.$plural_24['y']),
                array(50, '|:count| '.$plural_else['y']),
                array(51, '|:count| '.$singular_1['y']),
                array(54, '|:count| '.$plural_24['y']),
                array(60, '|:count| '.$plural_else['y']),
                array(61, '|:count| '.$singular_1['y']),
                array(64, '|:count| '.$plural_24['y']),
                array(70, '|:count| '.$plural_else['y']),
                array(71, '|:count| '.$singular_1['y']),
                array(74, '|:count| '.$plural_24['y']),
                array(80, '|:count| '.$plural_else['y']),
                array(81, '|:count| '.$singular_1['y']),
                array(84, '|:count| '.$plural_24['y']),
                array(90, '|:count| '.$plural_else['y']),
                array(91, '|:count| '.$singular_1['y']),
                array(94, '|:count| '.$plural_24['y']),
                          '|:count| '.$plural_else['y']),
    'meta'  => array(
                'after_now'     => 'через |:phrase|',
                'before_now'    => '|:phrase| назад'
                )
    );
