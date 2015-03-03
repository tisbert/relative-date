<?php

field::$methods['relative'] = function($field, $gran=-1) {
    if (count(site()->languages()) < 1)
        $language = 'en';
    else
        $language = site()->language()->code();
    $field->value = ftime($field->page->date(false, $field->key), $language, $gran);
    return $field;
};

function fTime($time, $language, $gran=-1) {

    $languages = array(
        'en' => array(
            array('second','seconds'),
            array('minute','minutes'),
            array('hour','hours'),
            array('day','days'),
            array('week','weeks'),
            array('month','months'),
            array('year','years'),
            'ago',
            'left',
            'AFTER'
            ),
        'de' => array(
            array('Sekunde','Sekunden'),
            array('Minute','Minuten'),
            array('Stunde','Stunden'),
            array('Tag','Tagen'),
            array('Woche','Wochen'),
            array('Monat','Monaten'),
            array('Jahr','Jahren'),
            'vor',
            'noch',
            'BEFORE'
            )
      );


    $d[0] = array(1,$languages[$language][0][0],$languages[$language][0][1]);
    $d[1] = array(60,$languages[$language][1][0],$languages[$language][1][1]);
    $d[2] = array(3600,$languages[$language][2][0],$languages[$language][2][1]);
    $d[3] = array(86400,$languages[$language][3][0],$languages[$language][3][1]);
    $d[4] = array(604800,$languages[$language][4][0],$languages[$language][4][1]);
    $d[5] = array(2592000,$languages[$language][5][0],$languages[$language][5][1]);
    $d[6] = array(31104000,$languages[$language][6][0],$languages[$language][6][1]);

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

    $relative = ($diff>0)?$languages[$language][7]:$languages[$language][8];
    if ($languages[$language][9]=='BEFORE') :
        return $relative.' '.$return;
    else :
        return $return.$relative;
    endif;
}
