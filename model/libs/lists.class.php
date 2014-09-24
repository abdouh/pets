<?php

//lists options
class Lists {

    static function ads_types($par = '') {
        return array(
            array('value' => 1, 'text' => $par . ' للبيع'),
            array('value' => 2, 'text' => 'ذكور للزواج')
            
            );
    }

    static function trader_type() {
        return array(
            array('value' => 'customer', 'text' => 'عميل'),
            array('value' => 'supplier', 'text' => 'موزع'),
            array('value' => 'both', 'text' => 'عميل & موزع'),
        );
    }

    static function trader_category() {
        return array(
            array('value' => 'wholesaler', 'text' => 'تاجر جملة'),
        );
    }

    static function store_type() {
        return array(
            array('value' => '1', 'text' => ''),
        );
    }

    static function market_type() {
        return array(
            array('value' => '1', 'text' => ''),
        );
    }

}