<?php

class ads {

    static function load_ads($img = 5, $settings = array()) {
        $page = isset($settings['page']) ? $settings['page'] : 1;
        $elements_per_page = 18;
        $offset = ($page - 1) * $elements_per_page;
        $limit = "$offset,$elements_per_page";

        $query_array = array();
        $query_end = '';
        foreach ($settings as $setting => $value) {
            if ($setting == 'page')
                continue;
            $query_array[] = "`$setting` = '$value'";
        }
        if (!empty($query_array))
            $query_end = 'WHERE ' . join(' AND ', $query_array);

        $table = db::$tables['ads'];
        $query = "SELECT * FROM $table $query_end ORDER BY `time_added` DESC LIMIT $limit";
        $stmt = db::getInstance()->query($query);
        $result = db::getInstance()->fetchAll($stmt);

        $ads = array();
        foreach ($result as $index => $array) {
            $ads[$index] = $array;
            $ads[$index]['img'] = self::load_ad_img($array['id'], $img);
        }


        return $ads;
    }

    static function load_ad_img($ad_id, $img = 5) {
        $table = db::$tables['ads_img'];
        $query = "SELECT * FROM $table WHERE `ad_id` = '$ad_id' LIMIT $img";
        $stmt = db::getInstance()->query($query);
        $result = db::getInstance()->fetchAll($stmt);

        if ($img == 1)
            return $result[0]['img_name'];

        $imgs = array();
        foreach ($result as $index => $array) {
            $imgs[] = $array['img_name'];
        }
        return $imgs;
    }

    static function pagination() {
        
    }

}
