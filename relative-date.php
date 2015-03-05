<?php

field::$methods['relative'] = function($field, $threshold = false, $gran = false) {

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

    /* Fallback to global threshold config if not provided */
    if ($threshold == false) $threshold = c::get('relativedate.threshold', false);

    /* only convert to relative if time differnce no exceeds threshold */
    if ($threshold == false ||
        abs(strtotime($field->value) - time()) <= $threshold) :
        $field->value = relativeTime($field->value, $language, $gran);
    endif;

    return $field;
};

function relativeTime($time, $language, $gran) {
    $date = new DateTime($time);
    $now  = new DateTime();
    $diff = $now->diff($date);

    $meta_keys = array_keys($language['meta']);

    if (c::get('relativedate.fuzzy', true) &&
        array_key_exists('supports', $language) &&
        $language['supports'] >= 1.0) :

        /* today (ab 5 h difference but same exact calendar day) */
        if ($diff->y == 0 &&
            $diff->m == 0 &&
            $diff->d == 0 &&
            $diff->h >= 5 &&
            $date->format('j') == $now->format('j'))
            return $language['fuzzy']['today'];

        /*  tomorrow/yesterday */
        $date_next   = new DateTime($time);
        $date_next->modify('+1 day');
        $date_before = new DateTime($time);
        $date_before->modify('-1 day');

        if ($diff->y == 0 &&
            $diff->m == 0 &&
            $diff->d <= 2 &&
            ($date_next->format('j') == $now->format('j') ||
            $date_before->format('j') == $now->format('j')))
            return $language['fuzzy']['1day'][$diff->invert];

        /* (last/next) WEEKDAY (up till 6 days difference) */
        if ($diff->y == 0 &&
            $diff->m == 0 &&
            $diff->d >= 1 &&
            $diff->d < 7)
            return str_replace('|:reference|',
                                $language['fuzzy'][$date->format('D')],
                                $language['meta'][$meta_keys[$diff->invert + 2]]);

        /* (last/next) week (nur +/-1 KW) */
        $date_next   = new DateTime($time);
        $date_next->modify('+1 week');
        $date_before = new DateTime($time);
        $date_before->modify('-1 week');
        if ($diff->y == 0 &&
            $diff->m == 0 &&
            ($date_next->format('W') == $now->format('W') ||
            $date_before->format('W') == $now->format('W')))
            return str_replace('|:reference|',
                                $language['fuzzy']['week'],
                                $language['meta'][$meta_keys[$diff->invert + 2]]);

        /* (last/next) month (+/-1 Kalendermonat) */
        $date_next   = new DateTime($time);
        $date_next->modify('+1 month');
        $date_before = new DateTime($time);
        $date_before->modify('-1 month');
        if ($diff->y == 0 &&
            ($date_next->format('n') == $now->format('n') ||
            $date_before->format('n') == $now->format('n')))
            return str_replace('|:reference|',
                                $language['fuzzy']['month'],
                                $language['meta'][$meta_keys[$diff->invert + 2]]);
    endif;

    $phrase = "";
    $elements = 0;
    if ($diff->y > 0 && $elements<$gran) :
        $phrase .= add2phrase($diff->y , $language['y']);
        $elements++;
    endif;
    if ($diff->m > 0 && $elements<$gran) :
        $phrase .= add2phrase($diff->m , $language['m']);
        $elements++;
    endif;
    $weeks = intval($diff->d/7);
    if ($weeks > 0 && $elements<$gran) :
        $phrase .= add2phrase($weeks, $language['w']);
        $elements++;
    endif;
    $days = $diff->d - ($weeks * 7);
    if ($days > 0 && $elements<$gran) :
        $phrase .= add2phrase($days, $language['d']);
        $elements++;
    endif;
    if ($diff->h > 0 && $elements<$gran) :
        $phrase .= add2phrase($diff->h , $language['h']);
        $elements++;
    endif;
    if ($diff->i > 0 && $elements<$gran) :
        $phrase .= add2phrase($diff->i , $language['min']);
        $elements++;
    endif;
    if ($diff->s > 0 && $elements<$gran) :
        $phrase .= add2phrase($diff->s , $language['sec']);
        $elements++;
    endif;

    /* Adding prefix or suffix */
    $return = str_replace('|:phrase|', $phrase, $language['meta'][$meta_keys[$diff->invert]]);

    return $return;
}


function add2phrase($count, $terms) {
    /* only has one form */
    if (count($terms) == 1) :
        $string = $terms[0]." ";

    /* simple singular/plural */
    elseif (count($terms) == 2 && !is_array($terms[1])) :
        if($count > 1)
            $string = $terms[1]." ";
        else
            $string = $terms[0]." ";

    /* plurals with specific rules */
    else:
        foreach ($terms as $term) :
            if (is_array($term)) {
                $condition = 'return '.str_replace('|:n|', $count, $term[0]).';';
                if (eval($condition)) {
                    $string = $term[1]." ";
                }
            }
        endforeach;
    endif;

    return str_replace('|:count|', $count, $string);
}
