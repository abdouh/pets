<?php

//lists options
class Lists {

    static function ads_types($par = '') {
        return array(
            array('value' => 1, 'text' => $par . ' للبيع'),
            array('value' => 2, 'text' => 'ذكور للزواج')
        );
    }

}