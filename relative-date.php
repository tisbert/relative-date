<?php

field::$methods['relative'] = function($field, $gran=-1) {
    include('relative-date-lang.php');

    if (count(site()->languages()) < 1)
        $language = 'en';
    else
        $language = site()->language()->code();

    if (!array_key_exists($language, $languages))
        $language = 'en';

    $field->value = ftime($field->page->date(false, $field->key), $language, $languages, $gran);
    return $field;
};

function fTime($time, $language, $languages, $gran=-1) {


    $d[0] = array(1,$languages[$language]['sec'][0],$languages[$language]['sec'][1]);
    $d[1] = array(60,$languages[$language]['min'][0],$languages[$language]['min'][1]);
    $d[2] = array(3600,$languages[$language]['h'][0],$languages[$language]['h'][1]);
    $d[3] = array(86400,$languages[$language]['d'][0],$languages[$language]['d'][1]);
    $d[4] = array(604800,$languages[$language]['w'][0],$languages[$language]['w'][1]);
    $d[5] = array(2592000,$languages[$language]['m'][0],$languages[$language]['m'][1]);
    $d[6] = array(31104000,$languages[$language]['y'][0],$languages[$language]['y'][1]);

    $w = array();

    $return = "";
    $now = time();
    $diff = ($now-$time);
    $secondsLeft = $diff;
    $stopat = 0;
    for($i=6;$i>$gran;$i--)
    {
         $w[$i] = intval($secondsLeft/$d[$i][0]);
         $secondsLeft -= ($w[$i]*$d[$i][0]);
         if($w[$i]!=0)
         {
            $return.= abs($w[$i]) . " " . (($w[$i]>1)?$d[$i][2]:$d[$i][1]) ." ";
             switch ($i) {
                case 6:
                    if ($stopat==0) $stopat=5;
                    break;
                case 5:
                    if ($stopat==0) $stopat=4;
                    break;
                case 4:
                    if ($stopat==0) $stopat=3;
                    break;
                case 3:
                    if ($stopat==0) $stopat=2;
                    break;
                case 2:
                    if ($stopat==0) $stopat=1;
                    break;
                case 1:
                    break;
             }
             if ($i===$stopat) break;
         }
    }

    $relative = ($diff>0)?$languages[$language]['meta']['later']:$languages[$language]['meta']['earlier'];
    if ($languages[$language]['meta']['position'] == 'begin') :
        return $relative.' '.$return;
    elseif ($languages[$language]['meta']['position'] == 'end') :
        return $return.$relative;
    else :
        return $return;
    endif;
}
