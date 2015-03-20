<?php

$rule0 = '|:n|==0';
$rule1 = '|:n|==1';
$rule2 = '|:n|==2';
$rule3 = '|:n|%100>=3 && |:n|%100<=10';
$rule4 = '|:n|%100>=11';
$rule5 = 'true';

return array(
    'sec'   => array(
                array($rule0, 'ثانية'),
                array($rule1, 'ثانية'),
                array($rule2, 'ثانيتين'),
                // array($rule3, '|:count| '),
                // array($rule4, '|:count| '),
                array($rule5, '|:count| ثوان'),
            ),
    'min'   => array(
                array($rule0, 'دقيقة'),
                array($rule1, 'دقيقة'),
                array($rule2, 'دقيقتين'),
                // array($rule3, '|:count| '),
                // array($rule4, '|:count| '),
                array($rule5, '|:count| دقائق'),
            ),
    'h'     => array(
                array($rule0, 'ساعة'),
                array($rule1, 'ساعة'),
                array($rule2, 'ساعتين'),
                // array($rule3, '|:count| '),
                // array($rule4, '|:count| '),
                array($rule5, '|:count| ساعات'),
            ),
    'd'     => array(
                array($rule0, 'يوم'),
                array($rule1, 'يوم'),
                array($rule2, 'يومين'),
                // array($rule3, '|:count| '),
                // array($rule4, '|:count| '),
                array($rule5, '|:count| أيام'),
            ),
    'w'     => array(
                array($rule0, 'أسبوع'),
                array($rule1, 'أسبوع'),
                array($rule2, 'أسبوعين'),
                // array($rule3, '|:count| '),
                // array($rule4, '|:count| '),
                array($rule5, '|:count| أسابيع'),
            ),
    'm'     => array(
                array($rule0, 'شهر'),
                array($rule1, 'شهر'),
                array($rule2, 'شهرين'),
                // array($rule3, '|:count| '),
                // array($rule4, '|:count| '),
                array($rule5, '|:count| شهور / أشهر'),
            ),
    'y'     => array(
                array($rule0, 'سنة'),
                array($rule1, 'سنة'),
                array($rule2, 'سنتين'),
                // array($rule3, '|:count| '),
                // array($rule4, '|:count| '),
                array($rule5, '|:count| سنوات / سنين'),
            ),
    'meta'  => array(
                'after_now'     => 'من الآن |:phrase|',
                'before_now'    => 'منذ |:phrase|'
                ),

    'supports' => 0.9,
    'author'   => 'distantnative (https://github.com/distantnative)'
    );
