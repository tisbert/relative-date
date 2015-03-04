<?php
$rule1 = '|:n|==1';
$rule2 = '|:n|%10>=2 && |:n|%10<=4 && (|:n|%100<10 || |:n|%100>=20)';
$rule3 = 'true';

return array(
    'sec'   => array(
                array($rule1, '|:count| sekunda'),
                array($rule2, '|:count| sekundy'),
                array($rule3, '|:count| sekund'),
            ),
    'min'   => array(
                array($rule1, '|:count| minuta'),
                array($rule2, '|:count| minuty'),
                array($rule3, '|:count| minut'),
            ),
    'h'     => array(
                array($rule1, '|:count| godzina'),
                array($rule2, '|:count| godziny'),
                array($rule3, '|:count| godzin'),
            ),
    'd'     => array(
                array($rule1, '|:count| dzień'),
                array($rule2, '|:count| dni'),
                array($rule3, '|:count| dni'),
            ),
    'w'     => array(
                array($rule1, '|:count| tydzień'),
                array($rule2, '|:count| tygodnie'),
                array($rule3, '|:count| tygodni'),
            ),
    'm'     => array(
                array($rule1, '|:count| miesiąc'),
                array($rule2, '|:count| miesiące'),
                array($rule3, '|:count| miesięcy'),
            ),
    'y'     => array(
                array($rule1, '|:count| rok'),
                array($rule2, '|:count| lata'),
                array($rule3, '|:count| lat'),
            ),
    'meta'  => array(
                'after_now'     => '|:phrase| od teraz',
                'before_now'    => '|:phrase| temu'
                )
    );
