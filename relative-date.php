<?php

field::$methods['relative'] = function($field) {
    include('relative-date-lang.php');

    if (count(site()->languages()) < 1)
        $language = 'en';
    else
        $language = site()->language()->code();

    if (!array_key_exists($language, $languages))
        $language = 'en';

    $field->value = ftime($field->page->date(false, $field->key), $language, $languages);
    return $field;
};

function fTime($time, $language, $languages) {


    $d[0] = array(
                1,
                $languages[$language]['sec'][0],
                $languages[$language]['sec'][1]
                );
    $d[1] = array(
                60,
                $languages[$language]['min'][0],
                $languages[$language]['min'][1]
                );
    $d[2] = array(
                3600,
                $languages[$language]['h'][0],
                $languages[$language]['h'][1]
                );
    $d[3] = array(
                86400,
                $languages[$language]['d'][0],
                $languages[$language]['d'][1]
                );
    $d[4] = array(
                604800,
                $languages[$language]['w'][0],
                $languages[$language]['w'][1]
                );
    $d[5] = array(
                2592000,
                $languages[$language]['m'][0],
                $languages[$language]['m'][1]
                );
    $d[6] = array(
                31104000,
                $languages[$language]['y'][0],
                $languages[$language]['y'][1]
                );


    $w = array();

    $phrase = "";
    $now = time();
    $diff = ($now-$time);
    $secondsLeft = $diff;
    $stopat = 0;

    for($i=6; $i>0; $i--)
    {
         $dateEl[$i] = intval($secondsLeft/$d[$i][0]);
         $secondsLeft -= ($dateEl[$i] * $d[$i][0]);
         if($dateEl[$i]!=0)
         {
            $phrase.= abs($dateEl[$i]) . " " . (($dateEl[$i]>1) ? $d[$i][2] : $d[$i][1]) ." ";
         }
    }

    $relative = ($diff > 0) ? $languages[$language]['meta']['later'] : $languages[$language]['meta']['earlier'];
    return str_replace('|:phrase|', $phrase, $relative);
}
