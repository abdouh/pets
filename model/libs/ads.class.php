<?php

class ads {

    static function load_ads($img = 5, $settings = array(), $get_count = 0) {

        $page = isset($settings['page']) ? $settings['page'] : 1;
        $elements_per_page = isset($settings['limit']) ? $settings['limit'] : 18;
        $offset = isset($settings['offset']) ? $settings['offset'] : ($page - 1) * $elements_per_page;
        $limit = "$offset,$elements_per_page";

        $settings_pars = array('page', 'limit', 'offset', 'words');
        if ($settings['limit'] == 'no')
            $limit = '';

        $query_array = array();
        $query_end = '';
        foreach ($settings as $setting => $value) {

            if ($setting == 'words') {
                $query_array[] = "((CONVERT(`title` USING utf8) LIKE  '%$value%') OR 
                    (CONVERT(`desc` USING utf8) LIKE  '%$value%'))";
            }

            if (in_array($setting, $settings_pars))
                continue;

            $query_array[] = "`$setting` = '$value'";
        }
        if (!empty($query_array))
            $query_end = 'WHERE ' . join(' AND ', $query_array);

        $table = db::$tables['ads'];
        $query = "SELECT count(*) as `count` FROM $table $query_end";
        $stmt = db::getInstance()->query($query);
        $result = db::getInstance()->fetchAll($stmt);
        $count = $result[0]['count'];

        if (!empty($limit))
            $limit = 'LIMIT ' . $limit;

        $query = "SELECT * FROM $table $query_end ORDER BY `time_added` DESC $limit";
        $stmt = db::getInstance()->query($query);
        $result = db::getInstance()->fetchAll($stmt);

        $ads = array();
        foreach ($result as $index => $array) {
            $ads[$index] = $array;
            $ads[$index]['img'] = self::load_ad_img($array['id'], $img);
        }

        if ($get_count)
            return array('count' => $count, 'ads' => $ads);

        return $ads;
    }

    static function load_ad_img($ad_id, $img = 5) {
        if (!$img)
            return;

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

    static function pagination($total) {
        $pages = array();
        if (isset($_GET['p']) && is_numeric($_GET['p']))
            $page = intval($_GET['p']);
        else
            $page = 1;
        if ($page > $total)
            $page = 1;
        return Temp::pagination_list($page, $_GET, $total);
    }

    static function get_country_name($country_id) {
        $table = db::$tables['countries'];
        $query = "SELECT * FROM $table WHERE `id` = '$country_id' LIMIT 1";
        $stmt = db::getInstance()->query($query);
        $result = db::getInstance()->fetchAll($stmt);
        return $result[0]['name'];
    }

    static function get_city_name($city_id) {
        $table = db::$tables['cities'];
        $query = "SELECT * FROM $table WHERE `id` = '$city_id' LIMIT 1";
        $stmt = db::getInstance()->query($query);
        $result = db::getInstance()->fetchAll($stmt);
        return $result[0]['name'];
    }

    static function get_region_name($region_id) {
        $table = db::$tables['regions'];
        $query = "SELECT * FROM $table WHERE `id` = '$region_id' LIMIT 1";
        $stmt = db::getInstance()->query($query);
        $result = db::getInstance()->fetchAll($stmt);
        return $result[0]['name'];
    }

}
