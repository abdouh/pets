<?php

//lists options
class Lists {

    static function ads_types() {
        return array(
            array('value' => 1, 'text' => ' بيع'),
            array('value' => 2, 'text' => 'ذكور للزواج'),
            array('value' => 3, 'text' => 'تبنى'),
            array('value' => 4, 'text' => 'مفقود'),
            array('value' => 5, 'text' => 'مستلزمات'),
        );
    }

    static function ads_cats() {
        $cats = array();
        $table = db::$tables['pets_categories'];
        $query = "SELECT * FROM $table";
        $stmt = db::getInstance()->query($query);
        $result = db::getInstance()->fetchAll($stmt);
        foreach ($result as $index => $array) {
            $cats[] = array('value' => $array['id'], 'text' => $array['cat_name']);
        }
        return $cats;
    }

    static function ads_pets($cat_id, $type) {
        $pets = array();
        if ($type == 5)
            return self::ads_acc();
        $table = db::$tables['pets'];
        $query = "SELECT * FROM $table WHERE `pet_cat` = '$cat_id'";
        $stmt = db::getInstance()->query($query);
        $result = db::getInstance()->fetchAll($stmt);
        foreach ($result as $index => $array) {
            $pets[] = array('value' => $array['id'], 'text' => $array['pet_name']);
        }
        return $pets;
    }

    static function ads_acc() {
        return array(
            array('value' => 1, 'text' => 'اكسسوارات'),
            array('value' => 2, 'text' => 'أكل'),
            array('value' => 3, 'text' => 'أدوية بيطرية'),
        );
    }

    static function ads_countries() {
        $countries = array();
        $table = db::$tables['countries'];
        $query = "SELECT * FROM $table";
        $stmt = db::getInstance()->query($query);
        $result = db::getInstance()->fetchAll($stmt);
        foreach ($result as $index => $array) {
            $countries[] = array('value' => $array['id'], 'text' => $array['name']);
        }
        return $countries;
    }

    static function ads_cities($country_id) {
        $cities = array();
        $table = db::$tables['cities'];
        $query = "SELECT * FROM $table WHERE `country_id` = '$country_id'";
        $stmt = db::getInstance()->query($query);
        $result = db::getInstance()->fetchAll($stmt);
        foreach ($result as $index => $array) {
            $cities[] = array('value' => $array['id'], 'text' => $array['name']);
        }
        return $cities;
    }

    static function ads_regions($city_id) {
        $regions = array();
        $table = db::$tables['regions'];
        $query = "SELECT * FROM $table WHERE `city_id` = '$city_id'";
        $stmt = db::getInstance()->query($query);
        $result = db::getInstance()->fetchAll($stmt);
        foreach ($result as $index => $array) {
            $regions[] = array('value' => $array['id'], 'text' => $array['name']);
        }
        return $regions;
    }

}
