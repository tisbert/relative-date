<?php
$rule1 = '|:n|%10==1 && |:n|%100!=11';
$rule2 = '|:n|%10>=2 && |:n|%10<=4 && (|:n|%100<10 || |:n|%100>=20)';
$rule3 = '|:n|!=0';

return array(
    'sec'   => array(
                array($rule1, '|:count| секунду'),
                array($rule2, '|:count| секунды'),
                array($rule3, '|:count| секунд'),
            ),
    'min'   => array(
                array($rule1, '|:count| минуту'),
                array($rule2, '|:count| минуты'),
                array($rule3, '|:count| минут'),
            ),
    'h'     => array(
                array($rule1, '|:count| час'),
                array($rule2, '|:count| часа'),
                array($rule3, '|:count| часов'),
            ),
    'd'     => array(
                array($rule1, '|:count| день'),
                array($rule2, '|:count| дня'),
                array($rule3, '|:count| дней'),
            ),
    'w'     => array(
                array($rule1, '|:count| неделю'),
                array($rule2, '|:count| недели'),
                array($rule3, '|:count| недель'),
            ),
    'm'     => array(
                array($rule1, '|:count| месяц'),
                array($rule2, '|:count| недели'),
                array($rule3, '|:count| недель'),
            ),
    'y'     => array(
                array($rule1, '|:count| год'),
                array($rule2, '|:count| года'),
                array($rule3, '|:count| лет'),
            ),
    'meta'  => array(
                'after_now'     => 'через |:phrase|',
                'before_now'    => '|:phrase| назад'
                )
    );
