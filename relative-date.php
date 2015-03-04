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
    $now = time();
    $diff = ($now-$time);

    /* Relative mode: $time is past or future? */
    $mode = ($diff > 0) ? 'before_now' : 'after_now';

    /* Setting up mode-sesitive languages */
    if (array_key_exists('lang_'.$mode, $language))
        $language = $language['lang_'.$mode];

    /* Linking language variables to respective calculation elements */
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


    /* Calculating relative elements */
    $dateEl = array();
    $phrase = "";
    $secondsLeft = $diff;
    $stopat = 0;
    $elements = 0;
    for($i=6; $i>0; $i--)
    {
         $dateEl[$i] = intval($secondsLeft/$d[$i][0]);
         $secondsLeft -= ($dateEl[$i] * $d[$i][0]);
         if($dateEl[$i]!=0)
         {
            /* Count > 1 >> some kind of plural */
            if($dateEl[$i]>1) :
                if (count($d[$i])>3) :
                    /* Go through differnt plurals */
                    foreach (array_slice($d[$i],2) as $term) :
                        if (is_array($term)) {
                            /* Specific plural in count rage? */
                            if ($term[0]<=$dateEl[$i]) $string = $term[1]." ";
                        } else {
                            /* Count is higher as all specific plural */
                            $string = $term." ";
                        }
                    endforeach;
                /* language only has singular/plural >> plural */
                else :
                    $string = array_pop($d[$i])." ";
                endif;
            /* Count = 1 >> simple singular */
            else :
                $string = $d[$i][1]." ";
            endif;

            $phrase.= str_replace('|:count|', abs($dateEl[$i]), $string);

            $elements++;
            if ($elements >= $gran) break;
         }
    }

    return str_replace('|:phrase|', $phrase, $language['meta'][$mode]);
}
