<?php

$rule1 = '|:n|==1';
$rule2 = '|:n|%10>=2 && |:n|%10<=4';
$rule3 = 'true';

return array(
    'sec'   => array(
                array($rule1, 'sekundu'),
                array($rule2, '|:count| sekundy'),
                array($rule3, '|:count| sekund'),
            ),
    'min'   => array(
                array($rule1, 'minutu'),
                array($rule2, '|:count| minuty'),
                array($rule3, '|:count| minut'),
            ),
    'h'     => array(
                array($rule1, 'hodinu'),
                array($rule2, '|:count| hodiny'),
                array($rule3, '|:count| hodin'),
            ),
    'd'     => array(
                array($rule1, 'den'),
                array($rule2, '|:count| dny'),
                array($rule3, '|:count| dni'),
            ),
    'w'     => array(
                array($rule1, 'týden'),
                array($rule2, '|:count| týdny'),
                array($rule3, '|:count| týdnů'),
            ),
    'm'     => array(
                array($rule1, 'měsíc'),
                array($rule2, '|:count| měsíce'),
                array($rule3, '|:count| měsíců'),
            ),
    'y'     => array(
                array($rule1, 'rok'),
                array($rule2, '|:count| roky'),
                array($rule3, '|:count| let'),
            ),
    'meta'  => array(
                'after_now'     => 'za |:phrase|',
                'before_now'    => 'před |:phrase|'
                )
    );
