<?php

field::$methods['relative'] = function($field, $gran = false) {

    /* Checking if Kirby language config is enabled */
    if (count(site()->languages()) < 1)
        $locale = c::get('relativedate.default', 'en');
    else
        $locale = site()->language()->code();

    /* Checking if current language is supported */
    if (!file_exists(__DIR__.'/lang/'.$locale.'.php'))
        $locale = c::get('relativedate.default', 'en');

    /* Getting the language array */
    $language = require 'lang/'.$locale.'.php';

    /* Fallback to global length config if not provided */
    if ($gran == false) $gran = c::get('relativedate.length', 2);

    $time = $field->page->date(false, $field->key);
    $field->value = ftime($time, $language, $gran);
    return $field;
};

function fTime($time, $language, $gran) {
    $now = time();
    $diff = ($now-$time);

    /* Relative mode: $time is past or future? */
    $mode = ($diff > 0) ? 'before_now' : 'after_now';

    /* Setting up mode-sesitive languages */
    if (array_key_exists('lang_'.$mode, $language))
        $words = $language['lang_'.$mode];
    else
        $words = $language;

    /* Linking language variables to respective calculation elements */
    $d[0] = array_merge( array(1),        $words['sec'] );
    $d[1] = array_merge( array(60),       $words['min'] );
    $d[2] = array_merge( array(3600),     $words['h'] );
    $d[3] = array_merge( array(86400),    $words['d'] );
    $d[4] = array_merge( array(604800),   $words['w'] );
    $d[5] = array_merge( array(2592000),  $words['m'] );
    $d[6] = array_merge( array(31104000), $words['sec'] );


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

    /* Making relative phrase fuzzy */
    if (c::get('relativedate.fuzzy', false) && array_key_exists('fuzzy', $language)) :
        foreach ($language['fuzzy'] as $fuzzyExp => $fuzzyTerm) :
            preg_replace('/'.$fuzzyExp.'/', $fuzzyTerm, $phrase);
        endforeach;
    endif;

    return str_replace('|:phrase|', $phrase, $language['meta'][$mode]);
}
