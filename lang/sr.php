<?php
$rule1 = '|:n|%10==1 && |:n|%100!=11';
$rule2 = '|:n|%10>=2 && |:n|%10<=4 && (|:n|%100<10 || |:n|%100>=20)';
$rule3 = 'true';

return array(
    'sec'   => array(
                array($rule1, '|:count| sekunde'),
                array($rule2, '|:count| sekunde'),
                array($rule3, '|:count| sekund'),
            ),
    'min'   => array(
                array($rule1, '|:count| minut'),
                array($rule2, '|:count| minuta'),
                array($rule3, '|:count| minuta'),
            ),
    'h'     => array(
                array($rule1, '|:count| sat'),
                array($rule2, '|:count| sata'),
                array($rule3, '|:count| sati'),
            ),
    'd'     => array(
                array($rule1, '|:count| dan'),
                array($rule2, '|:count| dana'),
                array($rule3, '|:count| dana'),
            ),
    'w'     => array(
                array($rule1, '|:count| nedelja'),
                array($rule2, '|:count| nedelje'),
                array($rule3, '|:count| nedelja'),
            ),
    'm'     => array(
                array($rule1, '|:count| mesec'),
                array($rule2, '|:count| meseca'),
                array($rule3, '|:count| meseci'),
            ),
    'y'     => array(
                array($rule1, '|:count| godina'),
                array($rule2, '|:count| godine'),
                array($rule3, '|:count| godina'),
            ),
    'meta'  => array(
                'after_now'     => '|:phrase| od sada',
                'before_now'    => 'pre |:phrase|'
                ),

    'supports' => 0.9,
    'author'   => 'distantnative (https://github.com/distantnative)'
    );
