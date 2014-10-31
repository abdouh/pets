<?php

class menu {

    static function load_pets($cat_id, $var_id, $type) {
        $table = db::$tables['pets'];
        $query = "SELECT * FROM $table WHERE `pet_cat` = '$cat_id' AND `pet_var` = '$var_id' ";
        $stmt = db::getInstance()->query($query);
        $result = db::getInstance()->fetchAll($stmt);
        $output = '';
        foreach ($result as $index => $array) {
            $link = READ_ONLY . "/?c={$array['pet_cat']}&pt={$array['id']}&ty=$type";
            $output .= "<li><a href='$link'>{$array['pet_name']}</a></li>\n";
        }
        return $output;
    }

}
