<?php

c::set('relativedate.fuzzy', array(

    /* English (en) */
    'en' => array(
        'tomorrow' => '/^[1-2]?[1-9] hour(s)?(.*)/',
        'less than a minute ago' => '/^[1-5]?[1-9] second(s)?(.*)/',
        'yesterday' => '/^(1 day(.*)|[1-2]?[1-9] hour(s)?(.*))/',
        ),

    /* German (de) */
    'de' => array(
        'gestern' => '/^(1 Tag(.*)|[1-2]?[1-9] Stunde(n)?(.*))/',
        ),

    ));
