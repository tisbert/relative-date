<?php

field::$methods['relative'] = function($field, $gran = false) {
    include('relative-date-lang.php');

    if (count(site()->languages()) < 1)
        $language = c::get('relativedate.default', 'en');
    else
        $language = site()->language()->code();

    if (!array_key_exists($language, $languages))
        $language = c::get('relativedate.default', 'en');

    if ($gran == false) $gran = c::get('relativedate.length', 2);

    $field->value = ftime($field->page->date(false, $field->key), $language, $languages, $gran);
    return $field;
};

function fTime($time, $language, $languages, $gran) {


    $d[0] = array(
                1,
                $languages[$language]['sec'][0],
                array_pop($languages[$language]['sec'])
                );
    $d[1] = array(
                60,
                $languages[$language]['min'][0],
                array_pop($languages[$language]['min'])
                );
    $d[2] = array(
                3600,
                $languages[$language]['h'][0],
                array_pop($languages[$language]['h'])
                );
    $d[3] = array(
                86400,
                $languages[$language]['d'][0],
                array_pop($languages[$language]['d'])
                );
    $d[4] = array(
                604800,
                $languages[$language]['w'][0],
                array_pop($languages[$language]['w'])
                );
    $d[5] = array(
                2592000,
                $languages[$language]['m'][0],
                array_pop($languages[$language]['m'])
                );
    $d[6] = array(
                31104000,
                $languages[$language]['y'][0],
                array_pop($languages[$language]['y'])
                );


    $w = array();

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
            $phrase.= abs($dateEl[$i]) . " " . (($dateEl[$i]>1) ? $d[$i][2] : $d[$i][1]) ." ";
            $elements++;
            if ($elements >= $gran) break;
         }
    }

    $relative = ($diff > 0) ? $languages[$language]['meta']['before_now'] : $languages[$language]['meta']['after_now'];
    return str_replace('|:phrase|', $phrase, $relative);
}
