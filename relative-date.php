<?php

field::$methods['relative'] = function($field, $gran = false) {

    if (count(site()->languages()) < 1)
        $locale = c::get('relativedate.default', 'en');
    else
        $locale = site()->language()->code();

    if (!file_exists(__DIR__.'/lang/'.$locale.'.php'))
        $locale = c::get('relativedate.default', 'en');

    $language = require 'lang/'.$locale.'.php';

    if ($gran == false) $gran = c::get('relativedate.length', 2);

    $field->value = ftime($field->page->date(false, $field->key), $language, $gran);
    return $field;
};

function fTime($time, $language, $gran) {

    $d[0] = array_merge(
                array(1),
                $language['sec']
            );
    $d[1] = array_merge(
                array(60),
                $language['min']
            );
    $d[2] = array_merge(
                array(3600),
                $language['h']
            );
    $d[3] = array_merge(
                array(86400),
                $language['d']
            );
    $d[4] = array_merge(
                array(604800),
                $language['w']
            );
    $d[5] = array_merge(
                array(2592000),
                $language['m']
            );
    $d[6] = array_merge(
                array(31104000),
                $language['sec']
            );


    $dateEl = array();
    $phrase = "";
    $now = time();
    $diff = ($now-$time);
    $secondsLeft = $diff;
    $stopat = 0;
    $elements = 0;
    for($i=6; $i>0; $i--)
    {
         $dateEl[$i] = intval($secondsLeft/$d[$i][0]);
         $secondsLeft -= ($dateEl[$i] * $d[$i][0]);
         if($dateEl[$i]!=0)
         {
            if($dateEl[$i]>1) :
                if (count($d[$i])>3) :
                    foreach (array_slice($d[$i],2) as $term) :
                        if (is_array($term)) {
                            if ($term[0]<=$dateEl[$i]) $string = $term[1]." ";
                        } else {
                            $string = $term." ";
                        }
                    endforeach;
                else :
                    $string = array_pop($d[$i])." ";
                endif;
            else :
                $string = $d[$i][1]." ";
            endif;

            $phrase.= str_replace('|:count|', abs($dateEl[$i]), $string);

            $elements++;
            if ($elements >= $gran) break;
         }
    }

    $relative = ($diff > 0) ? $language['meta']['before_now'] : $language['meta']['after_now'];
    return str_replace('|:phrase|', $phrase, $relative);
}
